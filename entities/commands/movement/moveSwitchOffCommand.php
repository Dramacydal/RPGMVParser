<?php

namespace rp\entities\commands\movement;

/**
 * Class moveSwitchOffCommand
 *
 * @package mh\entities\commands\movement
 */
class moveSwitchOffCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Switch OFF';
    }

    public function getSwitch(): int
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        $str = "#{$this->getSwitch()}";

        if ($switchName = $this->getP()->getSwitch($this->getSwitch())) {
            $str .= " {$switchName}";
        }

        return $str;
    }
}
