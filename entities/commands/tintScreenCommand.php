<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class tintScreenCommand
 *
 * @package mh\entities\commands
 */
class tintScreenCommand extends abstractCommand
{
    public function getName(): string
    {
        return 'Tint Screen';
    }

    public function getColor(): array
    {
        return $this->getParameter(0);
    }

    public function getDuration(): int
    {
        return $this->getParameter(1);
    }

    public function getWaitForCompletion(): bool
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        $color = $this->getColor();
        $str = "({$color[0]},{$color[1]},{$color[2]},{$color[3]}), {$this->getDuration()} frame(s)";
        if ($this->getWaitForCompletion()) {
            $str .= ' (Wait)';
        }

        return $str;
    }
}
