<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifWeaponCommand
 *
 *      [1] - weapon id
 *      [2] - check in equipment true/false
 *
 * @package mh\entities\commands\ifCommands
 */
class ifWeaponCommand extends ifCommand
{
    public function getWeapon(): int
    {
        return $this->getParameter(1);
    }

    public function getIncludeEquipment(): int
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        $str = "Party has weapon #{$this->getWeapon()}";
        if ($this->getIncludeEquipment()) {
            $str .= ' (include Equipment)';
        }

        return $str;
    }
}
