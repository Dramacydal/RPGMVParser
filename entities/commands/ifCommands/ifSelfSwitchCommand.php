<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifSelfSwitchCommand
 *
 *      [1] - switch name (A/B/etc)
 *      [2] - 0 - on, 1 - off
 *
 * @package mh\entities\commands\ifCommands
 */
class ifSelfSwitchCommand extends ifCommand
{
    const STATE_ON  = 0;
    const STATE_OFF = 1;

    public function getSwitchName(): string
    {
        return $this->getParameter(1);
    }

    public function getOnOff(): int
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        $str = "Self Switch {$this->getSwitchName()} is ";

        switch ($this->getOnOff()) {
            case self::STATE_ON:
                $str .= 'ON';
                break;
            case self::STATE_OFF:
                $str .= 'OFF';
                break;
            default:
                throw new \Exception("Unknown ON/OFF state for '{$this->getName()}' self switch command");
        }

        return $str;
    }
}
