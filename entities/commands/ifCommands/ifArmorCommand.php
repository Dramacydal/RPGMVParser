<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifArmorCommand
 *
 *      [1] - armor id
 *      [2] - check in equipment true/false
 *
 * @package mh\entities\commands\ifCommands
 */
class ifArmorCommand extends ifCommand
{
    public function getArmor(): int
    {
        return $this->getParameter(1);
    }

    public function getIncludeEquipment(): bool
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        $str = "Party has armor #{$this->getArmor()}";
        if ($this->getIncludeEquipment()) {
            $str .= ' (include Equipment)';
        }

        return $str;
    }
}
