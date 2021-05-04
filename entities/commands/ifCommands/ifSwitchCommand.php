<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifSwitchCommand
 *
 *      [1] - switch id
 *      [2] - 0 - on, 1 - off
 *
 * @package mh\entities\commands\ifCommands
 */
class ifSwitchCommand extends ifCommand
{
    const STATE_ON = 0;
    const STATE_OFF = 1;

    public function getSwitch(): int
    {
        return $this->getParameter(1);
    }

    public function getOnOff(): int
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        $str = "#{$this->getSwitch()}";
        if ($switchName = $this->getP()->getSwitch($this->getSwitch())) {
            $str .= " {$switchName}";
        }

        $str .= ' is ';
        switch ($this->getOnOff()) {
            case self::STATE_ON:
                $str .= 'ON';
                break;
            case self::STATE_OFF:
                $str .= 'OFF';
                break;
            default:
                throw new \Exception("Unknown ON/OFF state for '{$this->getName()}' switch command");
        }

        return $str;
    }
}
