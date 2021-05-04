<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class changeTransparencyCommand
 *
 * @package mh\entities\commands
 */
class changeTransparencyCommand extends abstractCommand
{
    const SET_ON  = 0;
    const SET_OFF = 1;

    function getName(): string
    {
        return 'Change Transparency';
    }

    public function getOnOffState(): int
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        switch ($this->getOnOffState()) {
            case self::SET_ON:
                return 'ON';
            case self::SET_OFF:
                return 'OFF';
            default:
                throw new \Exception("Unknown on/off state for change transparancy command");
        }
    }
}
