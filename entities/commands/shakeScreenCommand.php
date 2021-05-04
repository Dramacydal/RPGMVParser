<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class tintScreenCommand
 *
 * @package mh\entities\commands
 */
class shakeScreenCommand extends abstractCommand
{
    public function getName(): string
    {
        return 'Shake Screen';
    }

    public function getPower(): int
    {
        return $this->getParameter(0);
    }

    public function getSpeed(): int
    {
        return $this->getParameter(1);
    }

    public function getDuration(): int
    {
        return $this->getParameter(2);
    }

    public function getWaitForCompletion(): bool
    {
        return $this->getParameter(3);
    }

    public function getParametersDescription(): string
    {
        $str = "{$this->getPower()}, {$this->getSpeed()}, {$this->getDuration()} frame(s)";
        if ($this->getWaitForCompletion()) {
            $str .= ' (Wait)';
        }

        return $str;
    }
}
