<?php

namespace rp;

use rp\entities\abstractCommand;
use rp\entities\abstractCommandContainer;
use rp\entities\commands\callCommonEventCommand;
use rp\entities\commands\commentCommand;
use rp\entities\commands\controlVariableCommand;
use rp\entities\commands\ifCommand;
use rp\entities\commands\battleProcessingCommand;
use rp\entities\commands\changeArmorsCommand;
use rp\entities\commands\changeEnemyHpCommand;
use rp\entities\commands\changeEnemyMpCommand;
use rp\entities\commands\changeEnemyTpCommand;
use rp\entities\commands\changeExperienceCommand;
use rp\entities\commands\changeGoldCommand;
use rp\entities\commands\changeHpCommand;
use rp\entities\commands\changeItemsCommand;
use rp\entities\commands\changeLevelCommand;
use rp\entities\commands\changeMpCommand;
use rp\entities\commands\changeParameterCommand;
use rp\entities\commands\changeSkillCommand;
use rp\entities\commands\changeStateCommand;
use rp\entities\commands\changeTpCommand;
use rp\entities\commands\changeWeaponsCommand;
use rp\entities\commands\getLocationInfoCommand;
use rp\entities\commands\ifCommands\ifVariableCommand;
use rp\entities\commands\inputNumberCommand;
use rp\entities\commands\movePictureCommand;
use rp\entities\commands\recoverAllCommand;
use rp\entities\commands\selectItemCommand;
use rp\entities\commands\setEventLocationCommand;
use rp\entities\commands\setVehicleLocationCommand;
use rp\entities\commands\showChoicesCommand;
use rp\entities\commands\showPictureCommand;
use rp\entities\commands\transferPlayerCommand;
use rp\entities\commonEvent;
use rp\entities\eventPage;

class helper
{
    /**
     * @var parser
     */
    private $p;

    public function __construct(parser $p)
    {
        $this->p = $p;
    }

    function searchImages(array $patterns, bool $plainOutput = false): array
    {
        $commandChecker = function (int $commandIndex, abstractCommand $command) use($patterns) {
            $buildMatch = function(string $imageName) use ($commandIndex) {
                return [
                    strtolower($imageName) => [
                        'index' => $commandIndex,
                        'name' => $imageName,
                    ],
                ];
            };

            if ($command->getCode() == commandCodes::CODE_SHOW_PICTURE) {

                /** @var showPictureCommand $command */

                $imageName = $command->getPicture();
                if (empty($imageName)) {
                    return false;
                }

                foreach ($patterns as $pattern) {
                    if (preg_match($pattern, $imageName)) {
                        return $buildMatch($imageName);
                    }
                }
            } elseif ($command->getCode() == commandCodes::CODE_SHOW_CHOICES) {
                $res = [];
                /** @var showChoicesCommand $command */
                foreach ($command->getChoices() as $choice) {
                    if (preg_match('/\<p:(.+),\d+,\d+\>/i', $choice, $matches)) {
                        foreach ($patterns as $pattern) {
                            if (preg_match($pattern, $matches[1])) {
                                $res = array_merge($res, $buildMatch($matches[1]));
                            }
                        }
                    }
                }

                if (!empty($res)) {
                    return $res;
                }
            }

            return false;
        };

        return $this->searchCommands($commandChecker, $plainOutput);
    }

    private function commandWithVariable(abstractCommand $command, int $variableId): bool
    {
        switch ($command->getCode()) {
            case commandCodes::CODE_CONTROL_VARIABLES:
                /** @var controlVariableCommand $command */
                if ($command->getStartVariable() <= $variableId && $command->getEndVariable() >= $variableId )
                    return true;

                if ($command->getOperandType() == controlVariableCommand::OPERAND_VARIABLE) {
                    if ($command->getOperand1() == $variableId)
                        return true;
                }
                break;
            case commandCodes::CODE_IF:
                /** @var ifCommand $command */
                if ($command->getIfType() ==ifCommand::TYPE_VARIABLE) {
                    /** @var ifVariableCommand $command */
                    if ($command->getVariable() == $variableId) {
                        return true;
                    }
                    if ($command->getOperandType() == ifVariableCommand::OPERAND_VARIABLE) {
                        if ($command->getOperand() == $variableId) {
                            return true;
                        }
                    }
                }
                break;
            case commandCodes::CODE_INPUT_NUMBER:
                /** @var inputNumberCommand $command */
                if ($command->getVariable() == $variableId)
                    return true;
                break;
            case commandCodes::CODE_SELECT_ITEM:
                /** @var selectItemCommand $command */
                if ($command->getVariable() == $variableId)
                    return true;
                break;
            case commandCodes::CODE_CHANGE_GOLD:
                /** @var changeGoldCommand $command */
                if ($command->getOperandType() == changeGoldCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                    return true;
                break;
            case commandCodes::CODE_CHANGE_ITEMS:
                /** @var changeItemsCommand $command */
                if ($command->getOperandType() == changeItemsCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                break;
            case commandCodes::CODE_CHANGE_WEAPONS:
                /** @var changeWeaponsCommand $command */
                if ($command->getOperandType() == changeWeaponsCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                    break;
            case commandCodes::CODE_CHANGE_ARMORS:
                /** @var changeArmorsCommand $command */
                if ($command->getOperandType() == changeArmorsCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                break;
            case commandCodes::CODE_CHANGE_HP:
                /** @var changeHpCommand $command */
                if ($command->getSourceType() == changeHpCommand::SOURCE_TYPE_VARIABLE)
                    if ($command->getSource() == $variableId)
                        return true;
                if ($command->getOperandType() == changeHpCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                break;
            case commandCodes::CODE_CHANGE_MP:
                /** @var changeMpCommand $command */
                if ($command->getSourceType() == changeMpCommand::SOURCE_TYPE_VARIABLE)
                    if ($command->getSource() == $variableId)
                        return true;
                if ($command->getOperandType() == changeMpCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                break;
            case commandCodes::CODE_CHANGE_TP:
                /** @var changeTpCommand $command */
                if ($command->getSourceType() == changeTpCommand::SOURCE_TYPE_VARIABLE)
                    if ($command->getSource() == $variableId)
                        return true;
                if ($command->getOperandType() == changeTpCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                break;
            case commandCodes::CODE_CHANGE_STATE:
                /** @var changeStateCommand $command */
                if ($command->getSourceType() == changeStateCommand::SOURCE_TYPE_VARIABLE)
                    if ($command->getSource() == $variableId)
                        return true;
                break;
            case commandCodes::CODE_RECOVER_ALL:
                /** @var recoverAllCommand $command */
                if ($command->getSourceType() == recoverAllCommand::SOURCE_TYPE_VARIABLE)
                    if ($command->getSource() == $variableId)
                        return true;
                break;
            case commandCodes::CODE_CHANGE_EXP:
                /** @var changeExperienceCommand $command */
                if ($command->getSourceType() == changeExperienceCommand::SOURCE_TYPE_VARIABLE)
                    if ($command->getSource() == $variableId)
                        return true;
                if ($command->getOperandType() == changeExperienceCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                    break;
            case commandCodes::CODE_CHANGE_LEVEL:
                /** @var changeLevelCommand $command */
                if ($command->getSourceType() == changeLevelCommand::SOURCE_TYPE_VARIABLE)
                    if ($command->getSource() == $variableId)
                        return true;
                if ($command->getOperandType() == changeLevelCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                break;
            case commandCodes::CODE_CHANGE_PARAMETER:
                /** @var changeParameterCommand $command */
                if ($command->getSourceType() == changeParameterCommand::SOURCE_TYPE_VARIABLE)
                    if ($command->getSource() == $variableId)
                        return true;
                if ($command->getOperandType() == changeParameterCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                break;
            case commandCodes::CODE_CHANGE_SKILL:
                /** @var changeSkillCommand $command */
                if ($command->getSourceType() == changeSkillCommand::SOURCE_TYPE_VARIABLE)
                    if ($command->getSource() == $variableId)
                        return true;
                break;
            case commandCodes::CODE_TRANSFER_PLAYER:
                /** @var transferPlayerCommand $command */
                if ($command->getTransferType() == transferPlayerCommand::TRANSFER_BY_VARIABLE) {
                    if ($command->getMap() == $variableId) {
                        return true;
                    }
                    if ($command->getX() == $variableId) {
                        return true;
                    }
                    if ($command->getY() == $variableId) {
                        return true;
                    }
                }
                break;
            case commandCodes::CODE_SET_VEHICLE_LOCATION:
                /** @var setVehicleLocationCommand $command */
                if ($command->getTransferType() == setVehicleLocationCommand::TRANSFER_BY_VARIABLE) {
                    if ($command->getMap() == $variableId) {
                        return true;
                    }
                    if ($command->getX() == $variableId) {
                        return true;
                    }
                    if ($command->getY() == $variableId) {
                        return true;
                    }
                }
                break;
            case commandCodes::CODE_SET_EVENT_LOCATION:
                /** @var setEventLocationCommand $command */
                if ($command->getTransferType() == setVehicleLocationCommand::TRANSFER_BY_VARIABLE) {
                    if ($command->getX() == $variableId) {
                        return true;
                    }
                    if ($command->getY() == $variableId) {
                        return true;
                    }
                }
                break;
            case commandCodes::CODE_SHOW_PICTURE:
                /** @var showPictureCommand $command */
                if ($command->getPlaceType() == showPictureCommand::PLACE_BY_VARIABLE) {
                    if ($command->getX() == $variableId) {
                        return true;
                    }
                    if ($command->getY() == $variableId) {
                        return true;
                    }
                }
                break;
            case commandCodes::CODE_MOVE_PICTURE:
                /** @var movePictureCommand $command */
                if ($command->getPlaceType() == movePictureCommand::PLACE_BY_VARIABLE) {
                    if ($command->getX() == $variableId) {
                        return true;
                    }
                    if ($command->getY() == $variableId) {
                        return true;
                    }
                }
                break;
            case commandCodes::CODE_ROTATE_PICTURE:
                // 0 - layer
                // 1 - speed
                break;
            case commandCodes::CODE_TINT_PICTURE:
                // 0 - layer
                // 1 - tone, array [ r, g, b, gray ]
                // 2 - frames duration
                // 3 - use wait true/false
                break;
            case commandCodes::CODE_ERASE_PICTURE:
                // 0 - layer
                break;
            case commandCodes::CODE_BATTLE_PROCESSING:
                /** @var battleProcessingCommand $command */
                if ($command->getDesignationType() == battleProcessingCommand::DESIGNATION_TYPE_BY_VARIABLE) {
                    if ($command->getBattle() == $variableId) {
                        return true;
                    }
                }
                break;
            case commandCodes::CODE_GET_LOCATION_INFO:
                /** @var getLocationInfoCommand $command */
                if ($command->getDesignationType() == getLocationInfoCommand::DESIGNATION_TYPE_BY_VARIABLES) {
                    if ($command->getX() == $variableId) {
                        return true;
                    }
                    if ($command->getY() == $variableId) {
                        return true;
                    }
                }
                break;
            case commandCodes::CODE_CHANGE_ENEMY_HP:
                /** @var changeEnemyHpCommand $command */
                if ($command->getOperandType() == changeEnemyHpCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                break;
            case commandCodes::CODE_CHANGE_ENEMY_MP:
                /** @var changeEnemyMpCommand $command */
                if ($command->getOperandType() == changeEnemyHpCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                    break;
            case commandCodes::CODE_CHANGE_ENEMY_TP:
                /** @var changeEnemyTpCommand $command */
                if ($command->getOperandType() == changeEnemyHpCommand::OPERAND_VARIABLE)
                    if ($command->getOperand() == $variableId)
                        return true;
                break;
            default:
            {
//                $founds = [];
//                array_walk_recursive($cAction->getData()['parameters'], function ($param) use(&$founds, $variableId) {
//                    if (is_string($param) && stristr($param, "V[{$variableId}]") !== false) {
//                        $founds[] = $param;
//                    }
//                });
//
//                if (empty($founds)) {
//                    return false;
//                }

                break;
            }
        }

        return false;
    }

    function searchVariables(array $variableIds, bool $plainOutput = false)
    {
        return $this->searchCommands(function (int $commandIndex, abstractCommand $command) use ($variableIds) {
            $commandData = $command->getData();

            foreach ($variableIds as $variableId) {
                if ($this->commandWithVariable($command, $variableId)) {
                    return [
                        "variable_{$variableId}" => [
                            'index' => $commandIndex,
                            'string' => $command->asString(),
                            'params' => $commandData['parameters'],
                        ],
                    ];
                }
            }

            return false;
        }, $plainOutput);
    }

    function searchComment(array $patterns)
    {
        return $this->searchCommands(function (int $commandIndex, abstractCommand $command) use ($patterns) {
            if ($command->getCode() != commandCodes::CODE_COMMENT) {
                return false;
            }

            /** @var commentCommand $command */

            $text = $command->getComment();
            if (empty($text)) {
                return false;
            }

            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $text)) {
                    return [
                        $pattern => [
                            'index' => $commandIndex,
                            'text' => $text,
                        ],
                    ];
                }
            }

            return false;
        });
    }

    function searchEventUsages(array $eventIds): array
    {
        return $this->searchCommands(function (int $commandIndex, abstractCommand $command) use ($eventIds) {
            if ($command->getCode() != commandCodes::CODE_CALL_COMMON_EVENT) {
                return false;
            }

            /** @var callCommonEventCommand $command */

            if (in_array($command->getEventId(), $eventIds)) {
                return [
                    $command->getEventId() => [
                        'index' => $commandIndex,
                    ],
                ];
            }

            return false;
        });
    }

    function searchCommands(callable $checker, bool $plainOutput = false): array
    {
        $commonEventResult = [];
        $mapEventPageResult = [];

        $callback = new walkCallback();
        $callback->commonEventCommandCallback = function (int $commandIndex, abstractCommand $command, commonEvent $commonEvent) use ($checker, &$commonEventResult) {
            $result = $checker($commandIndex, $command);
            if ($result !== false) {
                foreach ($result as $key => $data) {
                    $eventData = &$commonEventResult[$key][$commonEvent->getId()];
                    if (empty($eventData)) {
                        $eventData['common_event_id'] = $commonEvent->getId();
                        $eventData['name'] = $commonEvent->getName();
                    }

                    $eventData['indexes'][] = $data;
                }
            }

            return true;
        };

        $callback->mapEventPageCommandCallback = function (int $commandIndex, abstractCommand $command, eventPage $page) use ($checker, &$mapEventPageResult) {
            $result = $checker($commandIndex, $command);
            if ($result !== false) {
                foreach ($result as $key => $data) {
                    $eventData = &$mapEventPageResult[$key][$page->getEvent()->getMapId()];
                    if (empty($eventData)) {
                        $eventData['map_id'] = $page->getEvent()->getMapId();
                        $eventData['map_name'] = $page->getEvent()->getMapName();
                    }

                    $mapEventEntry = &$eventData['events'][$page->getEventId()];
                    if (empty($mapEventEntry)) {
                        $mapEventEntry['event_id'] = $page->getEventId();
                        $mapEventEntry['event_name'] = $page->getEvent()->getName();
                        $mapEventEntry['x'] = $page->getEvent()->getX();
                        $mapEventEntry['y'] = $page->getEvent()->getY();
                    }

                    $pageEntry = &$mapEventEntry['pages'][$page->getId()];
                    if (empty($pageEntry)) {
                        $pageEntry['page_id'] = $page->getId();
                    }

                    $pageEntry['indexes'][] = $data;
                }
            }

            return true;
        };

        $this->p->walk($callback);

        if ($plainOutput) {
            $lines = [];

            $lines[] = "Common events:";
            if (empty($commonEventResult)) {
                $lines[] = '  None found.';
            } else {
                foreach ($commonEventResult as $name => $imageData) {
                    $lines[] = "  '{$name}':";
                    foreach ($imageData as $ceId => $ceData) {
                        $indexes = array_map(function($e) {
                            return $e['index'];
                        }, $ceData['indexes']);
                        $lines[] = sprintf("    #%s '%s': Lines: %s", $ceId, $ceData['name'], implode(', ', $indexes));
                    }
                }
            }

            $lines[] = '';
            $lines[] = "Map events:";
            if (empty($mapEventPageResult)) {
                $lines[] = '  None found.';
            } else {
                foreach ($mapEventPageResult as $name => $mapData) {
                    $lines[] = "  '{$name}':";
                    foreach ($mapData as $mapId => $mapEventData) {
                        $lines[] = sprintf("    Map '%s' (#%s):", $mapEventData['map_name'], $mapId);
                        foreach ($mapEventData['events'] as $eventId => $eventData) {
                            $lines[] = sprintf("      Event '%s' (#%s, X: %s, Y: %s):", $eventData['event_name'], $eventId, $eventData['x'], $eventData['y']);
                            foreach ($eventData['pages'] as $pageId => $pageData) {
                                $indexes = array_map(function($e) {
                                    return $e['index'];
                                }, $pageData['indexes']);
                                $lines[] = sprintf("        Page %s: %s", $pageId, implode(', ', $indexes));
                            }
                        }
                    }
                }
            }

            return $lines;
        }

        return [
            'common' => $commonEventResult,
            'map' => $mapEventPageResult,
        ];
    }

    /**
     * @param abstractCommandContainer $commandContainer
     *
     * @return string
     */
    private static function commandsListToString(abstractCommandContainer $commandContainer): string
    {
        return implode(PHP_EOL, array_map(function (abstractCommand $command) {
            return $command->asString(true);
        }, iterator_to_array($commandContainer->getCommands())));
    }

    /**
     * @param commonEvent $commonEvent
     * @param bool|false  $toFile
     *
     * @return string
     */
    public static function dumpCommonEvent(commonEvent $commonEvent, $toFile = false)
    {
        $text = static::commandsListToString($commonEvent);
        if ($toFile === false) {
            return $text;
        }

        if (empty($toFile) || !is_string($toFile)) {
            $toFile = "./events/common_event_{$commonEvent->getId()}.txt";
        }

        file_put_contents($toFile, $text);

        return $text;
    }

    /**
     * @param eventPage  $eventPage
     * @param bool|false $toFile
     *
     * @return string
     */
    public static function dumpEventPage(eventPage $eventPage, $toFile = false)
    {
        $text = static::commandsListToString($eventPage);
        if ($toFile === false) {
            return $text;
        }

        if (empty($toFile) || !is_string($toFile)) {
            $toFile = "./events/map_{$eventPage->getEvent()->getMapId()}_{$eventPage->getEvent()->getMapName()}_event_{$eventPage->getEventId()}_x_{$eventPage->getEvent()->getX()}_y_{$eventPage->getEvent()->getY()}_page_{$eventPage->getId()}.txt";
        }

        file_put_contents($toFile, $text);

        return $text;
    }

    public function searchNotUsedImages()
    {
        $files = scandir($this->p->getGameDirectory() . '/www/img/pictures');
        $files = array_filter($files, function ($file) {
            return stripos($file, '.rpgmvp') !== false || stripos($file, '.png') !== false;
        });

        if (empty($files)) {
            return [];
        }

        $res = $this->searchImages([ '/.+/' ]);

        $notUsed = [];
        foreach ($files as $file) {
            $baseName = strtolower(pathinfo($file, PATHINFO_FILENAME));

            if (!isset($res['common'][$baseName]) && !isset($res['map'][$baseName])) {
                $notUsed[] = $baseName;
            }
        }

        $notUsed = array_unique($notUsed);
        sort($notUsed);

        return $notUsed;
    }
}
