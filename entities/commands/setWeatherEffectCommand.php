<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class setWeatherEffectCommand
 *
 * @package mh\entities\commands
 */
class setWeatherEffectCommand extends abstractCommand
{
    const TYPE_NONE = 'none';

    function getName(): string
    {
        return 'Set Weather Effect';
    }

    public function getType(): string
    {
        return $this->getParameter(0);
    }

    public function getPower(): int
    {
        return $this->getParameter(1);
    }

    public function getDuration(): int
    {
        return $this->getParameter(2);
    }

    public function getWaitForCompletion():bool
    {
        return $this->getParameter(3);
    }

    public function getParametersDescription(): string
    {
        if ($this->getType() == self::TYPE_NONE) {
            $str = 'None';
        } else {
            $str = ucfirst($this->getType()) . ", {$this->getPower()}";
        }

        $str .= ", {$this->getDuration()} frame(s)";
        if ($this->getWaitForCompletion()) {
            $str .= ' (Wait)';
        }

        return $str;
    }
}
