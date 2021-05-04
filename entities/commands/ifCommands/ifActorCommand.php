<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifActorCommand
 *
 *      [1] - unit id
 *      [2] - type
 *          0 - in party
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
 *
 * @package mh\entities\commands\ifCommands
 */
class ifActorCommand extends ifCommand
{
    const CHECK_IN_PARTY        = 0;
    const CHECK_NAME            = 1;
    const CHECK_CLASS           = 2;
    const CHECK_SKILL           = 3;
    const CHECK_WEAPON_EQUIPPED = 4;
    const CHECK_ARMOR_EQUIPPED  = 5;
    const CHECK_STATE           = 6;

    public function getUnitId(): int
    {
        return $this->getParameter(1);
    }

    public function getCheckType(): int
    {
        return $this->getParameter(2);
    }

    public function getCheckParameter()
    {
        return $this->getParameter(3);
    }

    public function getParametersDescription(): string
    {
        $str = "Unit #{$this->getUnitId()}";

        switch ($this->getCheckType()) {
            case self::CHECK_IN_PARTY:
                $str .= ' is in the party';
                break;
            case self::CHECK_NAME:
                $str .= " name is '{$this->getCheckParameter()}'";
                break;
            case self::CHECK_CLASS:
                $str .= " class is #{$this->getCheckParameter()}";
                break;
            case self::CHECK_SKILL:
                $str .= " has learned #{$this->getCheckParameter()}";
                break;
            case self::CHECK_WEAPON_EQUIPPED:
                $str .= " has equipped weapon #{$this->getCheckParameter()}";
                break;
            case self::CHECK_ARMOR_EQUIPPED:
                $str .= " has equipped armor #{$this->getCheckParameter()}";
                break;
            case self::CHECK_STATE:
                $str .= " is affected by #{$this->getCheckParameter()} state";
                break;
            default:
                throw new \Exception("Unknown check type '{$this->getCheckType()}' for '{$this->getName()}' actor command");
        }

        return $str;
    }
}
