<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class controlSwitchCommand
 *
 * @package mh\entities\commands
 */
class controlSwitchCommand extends abstractCommand
{
    const ON_STATE = 0;
    const OFF_STATE = 1;

    public function getStartSwitch(): int
    {
        return $this->getParameter(0);
    }

    public function getEndSwitch(): int
    {
        return $this->getParameter(1);
    }

    public function getOnOffState(): int
    {
        return $this->getParameter(2);
    }

    public function getName(): string
    {
        return 'Control Switches';
    }

    public function getParametersDescription(): string
    {
        if ($this->getStartSwitch() != $this->getEndSwitch()) {
            $str = "#{$this->getStartSwitch()}..{$this->getEndSwitch()}";
        } else {
            $str = "#{$this->getStartSwitch()}";
            if ($switchName = $this->getP()->getSwitch($this->getStartSwitch())) {
                $str .= " {$switchName}";
            }
        }

        switch ($this->getOnOffState()) {
            case self::ON_STATE:
                $str .= ' = ON';
                break;
            case self::OFF_STATE:
                $str .= ' = OFF';
                break;
            default:
                throw new \Exception("Unknown on/off state {$this->getOnOffState()} for action #{$this->getCode()} {$this->getName()}");
        }

        return $str;
    }
}