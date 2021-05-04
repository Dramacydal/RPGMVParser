<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class controlSelfSwitchCommand
 *
 * @package mh\entities\commands
 */
class controlSelfSwitchCommand extends abstractCommand
{
    const ON_STATE  = 0;
    const OFF_STATE = 1;

    public function getSwitch(): string
    {
        return $this->getParameter(0);
    }

    public function getOnOffState(): int
    {
        return $this->getParameter(1);
    }

    public function getName(): string
    {
        return 'Control Self Switch';
    }

    public function getParametersDescription(): string
    {
        $str = $this->getSwitch();
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
