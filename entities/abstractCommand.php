<?php

namespace rp\entities;

use rp\commandCodes;
use rp\entities\commands\callCommonEventCommand;
use rp\entities\commands\changeActorImagesCommand;
use rp\entities\commands\changePartyMemberCommand;
use rp\entities\commands\changeTransparencyCommand;
use rp\entities\commands\choiceCaseCommand;
use rp\entities\commands\choiceCaseCancelCommand;
use rp\entities\commands\commentCommand;
use rp\entities\commands\commentContinueCommand;
use rp\entities\commands\controlSelfSwitchCommand;
use rp\entities\commands\controlSwitchCommand;
use rp\entities\commands\controlVariableCommand;
use rp\entities\commands\elseCommand;
use rp\entities\commands\emptyCommand;
use rp\entities\commands\endChoicesCommand;
use rp\entities\commands\endIfCommand;
use rp\entities\commands\erasePictureCommand;
use rp\entities\commands\exitEventProcessingCommand;
use rp\entities\commands\fadeinScreenCommand;
use rp\entities\commands\fadeoutBGMCommand;
use rp\entities\commands\fadeoutScreenCommand;
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
use rp\entities\commands\inputNumberCommand;
use rp\entities\commands\jumpToLabelCommand;
use rp\entities\commands\labelCommand;
use rp\entities\commands\movementRouteCommand;
use rp\entities\commands\movePictureCommand;
use rp\entities\commands\playBGMCommand;
use rp\entities\commands\playMECommand;
use rp\entities\commands\playSECommand;
use rp\entities\commands\pluginCommand;
use rp\entities\commands\recoverAllCommand;
use rp\entities\commands\replayBGMCommand;
use rp\entities\commands\rotatePictureCommand;
use rp\entities\commands\saveBGMCommand;
use rp\entities\commands\scriptCommand;
use rp\entities\commands\scrollMapCommand;
use rp\entities\commands\selectItemCommand;
use rp\entities\commands\setEventLocationCommand;
use rp\entities\commands\setMovementRouteCommand;
use rp\entities\commands\setVehicleLocationCommand;
use rp\entities\commands\setWeatherEffectCommand;
use rp\entities\commands\shakeScreenCommand;
use rp\entities\commands\showAnimationCommand;
use rp\entities\commands\showBalloonCommand;
use rp\entities\commands\showChoicesCommand;
use rp\entities\commands\showPictureCommand;
use rp\entities\commands\showTextBaseCommand;
use rp\entities\commands\showTextLineCommand;
use rp\entities\commands\tintScreenCommand;
use rp\entities\commands\transferPlayerCommand;
use rp\entities\commands\placeholderCommand;
use rp\entities\commands\waitCommand;
use rp\parser;

abstract class abstractCommand extends abstractEntity
{
    /**
     * @var abstractCommandContainer
     */
    private $commandContainer;

    protected $isSecondary;

    public static function factory(array $commandData, parser $w): self
    {
        $code = $commandData['code'] ?? '';
        switch ($code) {
            case commandCodes::CODE_EMPTY:
                return new emptyCommand($commandData, $w);
            case commandCodes::CODE_COMMENT:
                return new commentCommand($commandData, $w);
            case commandCodes::CODE_COMMENT_CONTINUE:
                return new commentContinueCommand($commandData, $w);
            case commandCodes::CODE_SHOW_TEXT_BASE:
                return new showTextBaseCommand($commandData, $w);
            case commandCodes::CODE_SHOW_TEXT_LINE:
                return new showTextLineCommand($commandData, $w);
            case commandCodes::CODE_CONTROL_SWITCHES:
                return new controlSwitchCommand($commandData, $w);
            case commandCodes::CODE_CONTROL_VARIABLES:
                return new controlVariableCommand($commandData, $w);
            case commandCodes::CODE_CONTROL_SELF_SWITCH:
                return new controlSelfSwitchCommand($commandData, $w);
            case commandCodes::CODE_IF:
                return ifCommand::factory($commandData, $w);
            case commandCodes::CODE_INPUT_NUMBER:
                return new inputNumberCommand($commandData, $w);
            case commandCodes::CODE_SELECT_ITEM:
                return new selectItemCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_GOLD:
                return new changeGoldCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_ITEMS:
                return new changeItemsCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_WEAPONS:
                return new changeWeaponsCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_ARMORS:
                return new changeArmorsCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_PARTY_MEMBER:
                return new changePartyMemberCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_HP:
                return new changeHpCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_MP:
                return new changeMpCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_TP:
                return new changeTpCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_STATE:
                return new changeStateCommand($commandData, $w);
            case commandCodes::CODE_RECOVER_ALL:
                return new recoverAllCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_EXP:
                return new changeExperienceCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_LEVEL:
                return new changeLevelCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_PARAMETER:
                return new changeParameterCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_SKILL:
                return new changeSkillCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_ACTOR_IMAGES:
                return new changeActorImagesCommand($commandData, $w);
            case commandCodes::CODE_TRANSFER_PLAYER:
                return new transferPlayerCommand($commandData, $w);
            case commandCodes::CODE_SET_VEHICLE_LOCATION:
                return new setVehicleLocationCommand($commandData, $w);
            case commandCodes::CODE_SET_EVENT_LOCATION:
                return new setEventLocationCommand($commandData, $w);
            case commandCodes::CODE_SCROLL_MAP:
                return new scrollMapCommand($commandData, $w);
            case commandCodes::CODE_SHOW_PICTURE:
                return new showPictureCommand($commandData, $w);
            case commandCodes::CODE_MOVE_PICTURE:
                return new movePictureCommand($commandData, $w);
            case commandCodes::CODE_ROTATE_PICTURE:
                return new rotatePictureCommand($commandData, $w);
            case commandCodes::CODE_TINT_PICTURE:
                // 0 - layer
                // 1 - tone, array [ r, g, b, gray ]
                // 2 - frames duration
                // 3 - use wait true/false
                break;
            case commandCodes::CODE_ERASE_PICTURE:
                return new erasePictureCommand($commandData, $w);
            case commandCodes::CODE_SET_WEATHER_EFFECT:
                return new setWeatherEffectCommand($commandData, $w);
            case commandCodes::CODE_BATTLE_PROCESSING:
                return new battleProcessingCommand($commandData, $w);
            case commandCodes::CODE_GET_LOCATION_INFO:
                return new getLocationInfoCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_ENEMY_HP:
                return new changeEnemyHpCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_ENEMY_MP:
                return new changeEnemyMpCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_ENEMY_TP:
                return new changeEnemyTpCommand($commandData, $w);
            case commandCodes::CODE_ELSE:
                return new elseCommand($commandData, $w);
            case commandCodes::CODE_ENDIF:
                return new endIfCommand($commandData, $w);
            case commandCodes::CODE_CALL_COMMON_EVENT:
                return new callCommonEventCommand($commandData, $w);
            case commandCodes::CODE_SCRIPT:
                return new scriptCommand($commandData, $w);
            case commandCodes::CODE_PLUGIN_COMMAND:
                return new pluginCommand($commandData, $w);
            case commandCodes::CODE_FADEOUT_SCREEN:
                return new fadeoutScreenCommand($commandData, $w);
            case commandCodes::CODE_FADEIN_SCREEN:
                return new fadeinScreenCommand($commandData, $w);
            case commandCodes::CODE_TINT_SCREEN:
                return new tintScreenCommand($commandData, $w);
            case commandCodes::CODE_SHAKE_SCREEN:
                return new shakeScreenCommand($commandData, $w);
            case commandCodes::CODE_WAIT:
                return new waitCommand($commandData, $w);
            case commandCodes::CODE_PLAY_BGM:
                return new playBGMCommand($commandData, $w);
            case commandCodes::CODE_SAVE_BGM:
                return new saveBGMCommand($commandData, $w);
            case commandCodes::CODE_REPLAY_BGM:
                return new replayBGMCommand($commandData, $w);
            case commandCodes::CODE_SHOW_CHOICES:
                return new showChoicesCommand($commandData, $w);
            case commandCodes::CODE_CHOICE_CASE:
                return new choiceCaseCommand($commandData, $w);
            case commandCodes::CODE_CHOICE_CASE_CANCEL:
                return new choiceCaseCancelCommand($commandData, $w);
            case commandCodes::CODE_CHOICES_END:
                return new endChoicesCommand($commandData, $w);
            case commandCodes::CODE_LABEL:
                return new labelCommand($commandData, $w);
            case commandCodes::CODE_JUMP_TO_LABEL:
                return new jumpToLabelCommand($commandData, $w);
            case commandCodes::CODE_FADEOUT_BGM:
                return new fadeoutBGMCommand($commandData, $w);
            case commandCodes::CODE_PLAY_ME:
                return new playMECommand($commandData, $w);
            case commandCodes::CODE_PLAY_SE:
                return new playSECommand($commandData, $w);
            case commandCodes::CODE_EXIT_EVENT_PROCESSING:
                return new exitEventProcessingCommand($commandData, $w);
            case commandCodes::CODE_SHOW_BALOON_ICON:
                return new showBalloonCommand($commandData, $w);
            case commandCodes::CODE_SET_MOVEMENT_ROUTE:
                return new setMovementRouteCommand($commandData, $w);
            case commandCodes::CODE_MOVEMENT_ROUTE_COMMAND:
                return new movementRouteCommand($commandData, $w);
            case commandCodes::CODE_CHANGE_TRANSPARENCY:
                return new changeTransparencyCommand($commandData, $w);
            case commandCodes::CODE_SHOW_ANIMATION:
                return new showAnimationCommand($commandData, $w);
            default:
                break;
        }

        return new placeholderCommand($commandData, $w);
    }

    public function getCode(): ?int
    {
        return $this->data[ 'code' ] ?? null;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->data['parameters'] ?? [];
    }

    /**
     * @param int $index
     *
     * @return mixed|null
     */
    public function getParameter(int $index)
    {
        return $this->data['parameters'][$index] ?? null;
    }

    /**
     * @param int $index
     * @param     $value
     */
    public function setParameter(int $index, $value)
    {
        $this->data['parameters'][$index] = $value;
        $this->setIsModified(true);
    }

    public function setIsModified(bool $on): void
    {
        parent::setIsModified($on);
        if ($this->commandContainer && $on) {
            $this->commandContainer->setIsModified(true);
        }
    }

    abstract function getName(): string;

    public function getParametersDescription(): string
    {
        return '';
    }

    /**
     * @param bool $withIndent
     *
     * @return string
     */
    public function asStringOld($withIndent = false): string
    {
        $indent = $withIndent && $this->getIndent() ? str_pad('', $this->getIndent(), ' ') : '';
        if ($this->getCode() == commandCodes::CODE_EMPTY) {
            return $indent;
        }

        $paramDescription = $this->getParametersDescription();
        if (empty($paramDescription)) {
            //return $indent . "{$indent}: {$this->getName()} ({$this->getCode()})";
            return "{$indent}{$this->getName()} ({$this->getCode()})";
        }

        $name = $this->getName();
        if (empty($name)) {
            return "{$indent}{$paramDescription} ({$this->getCode()})";
        }

        return "{$indent}{$this->getName()} : {$paramDescription} ({$this->getCode()})";
    }

    protected function getStringPrefix(): string
    {
        return !$this->isSecondary ? '◆' : ':';
    }

    /**
     * @param bool $withIndent
     *
     * @return string
     */
    public function asString($withIndent = false): string
    {
        $str = $withIndent && $this->getIndent() ? str_pad('', $this->getIndent(), ' ') : '';

        $str .= $this->getStringPrefix();

        $name = $this->getName();
        $str .= $name;

        $parametersDescription = $this->getParametersDescription();
        if (!empty($parametersDescription)) {
            $str .= ((empty(trim($name)) || !$this->isSecondary) ? ' : ' : ' ') . $parametersDescription;
        }

        $str .= " ({$this->getCode()})";

        return $str;
    }

    /**
     * @return int
     */
    public function getIndent(): int
    {
        return $this->data['indent'] ?? 0;
    }

    public function setContainer(abstractCommandContainer $param)
    {
        $this->commandContainer = $param;
    }
}