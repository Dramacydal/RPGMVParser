<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;
use rp\entities\commands\ifCommands\ifActorCommand;
use rp\entities\commands\ifCommands\ifArmorCommand;
use rp\entities\commands\ifCommands\ifButtonCommand;
use rp\entities\commands\ifCommands\ifEnemyCommand;
use rp\entities\commands\ifCommands\ifGoldCommand;
use rp\entities\commands\ifCommands\ifItemCommand;
use rp\entities\commands\ifCommands\ifCharacterCommand;
use rp\entities\commands\ifCommands\ifScriptCommand;
use rp\entities\commands\ifCommands\ifSelfSwitchCommand;
use rp\entities\commands\ifCommands\ifSwitchCommand;
use rp\entities\commands\ifCommands\ifTimerCommand;
use rp\entities\commands\ifCommands\ifVariableCommand;
use rp\entities\commands\ifCommands\ifVehicleCommand;
use rp\entities\commands\ifCommands\ifWeaponCommand;
use rp\parser;

/**
 * Class ifCommand
 *
 * 0 if type
 *   0 - switch
 *      [1] - switch id
 *      [2] - 0 - on, 1 - off
 *
 *   1 - variable
 *      [1] - variable id
 *      [2] - operand type, 0 - constant, 1 - variable
 *      [3] - constant or variable id
 *      [4] - operator, 0 - eq, 1 - gte, 2 - lte, 3 - gt, 4 - lt, 5 - neq
 *
 *   2 - self switch
 *      [1] - switch name (A/B/etc)
 *      [2] - 0 - on, 1 - off
 *
 *   3 - timer
 *      [1] - seconds count
 *      [2] - comp, 0 - gte, 1 - lte
 *
 *   4 - action unit
 *      [1] - unit id
 *      [2] - type
 *          0 - в стороне (?)
 *          1 - name check
 *            [3] - name
 *          2 - class check
 *            [3] - class id
 *          3 - skill check
 *            [3] - skill id
 *          4 - weapon equipped check
 *            [3] - weapon id
 *          5 - armor equipped check
 *            [3] - armor id
 *          6 - state check
 *            [3] - state id
 *   5 - enemy check
 *      [1] - enemy id
 *      [2] - check type
 *          0 - appeared (none params)
 *          1 - state check
 *            [3] - state id
 *   6 - orientation check
 *      [1] - source type, -1 - player, 0 - this event, else event id
 *      [2] - orientation mask, 2 - down, 4 - left, 6 - right, 8 - up
 *   7 - gold amount check
 *      [1] - amount
 *      [2] - operator, 0 - gte, 1 - lte, 2 - lt
 *   8 - item check
 *      [1] - item id
 *   9 - weapon check
 *      [1] - weapon id
 *      [2] - check in equipment true/false
 *   10 - armor check
 *      [1] - armor id
 *      [2] - check in equipment true/false
 *   11 - button pressed (?)
 *      [1] - button name
 *   12 - scenario
 *      [1] - scenario name
 *   13 - is inside vehicle
 *      [1] - vehicle id
 *
 * @package mh\entities\commands
 */
abstract class ifCommand extends abstractCommand
{
    const TYPE_SWITCH         = 0;
    const TYPE_VARIABLE       = 1;
    const TYPE_SELF_SWITCH    = 2;
    const TYPE_TIMER          = 3;
    const TYPE_ACTOR          = 4;
    const TYPE_ENEMY          = 5;
    const TYPE_CHARACTER      = 6;
    const TYPE_GOLD           = 7;
    const TYPE_ITEM           = 8;
    const TYPE_WEAPON         = 9;
    const TYPE_ARMOR          = 10;
    const TYPE_BUTTON         = 11;
    const TYPE_SCRIPT         = 12;
    const TYPE_VEHICLE        = 13;

    public static function factory(array $commandData, parser $w): abstractCommand
    {
        $ifType = $commandData['parameters'][0] ?? -1;

        switch ($ifType)
        {
            case self::TYPE_SWITCH:
                return new ifSwitchCommand($commandData, $w);
            case self::TYPE_VARIABLE:
                return new ifVariableCommand($commandData, $w);
            case self::TYPE_SELF_SWITCH:
                return new ifSelfSwitchCommand($commandData, $w);
            case self::TYPE_TIMER:
                return new ifTimerCommand($commandData, $w);
            case self::TYPE_ACTOR:
                return new ifActorCommand($commandData, $w);
            case self::TYPE_ENEMY:
                return new ifEnemyCommand($commandData, $w);
            case self::TYPE_CHARACTER:
                return new ifCharacterCommand($commandData, $w);
            case self::TYPE_GOLD:
                return new ifGoldCommand($commandData, $w);
            case self::TYPE_ITEM:
                return new ifItemCommand($commandData, $w);
            case self::TYPE_WEAPON:
                return new ifWeaponCommand($commandData, $w);
            case self::TYPE_ARMOR:
                return new ifArmorCommand($commandData, $w);
            case self::TYPE_BUTTON:
                return new ifButtonCommand($commandData, $w);
            case self::TYPE_SCRIPT:
                return new ifScriptCommand($commandData, $w);
            case self::TYPE_VEHICLE:
                return new ifVehicleCommand($commandData, $w);
            default:
                throw new \Exception("Unknown if type '{$ifType}' command");

        }
    }

    /**
     * @return int
     */
    public function getIfType(): int
    {
        return $this->getParameter(0);
    }

    function getName(): string
    {
        return "If";
    }
}