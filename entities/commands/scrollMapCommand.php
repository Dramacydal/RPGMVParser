<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class scrollMapCommand
 *
 * @package mh\entities\commands
 */
class scrollMapCommand extends abstractCommand
{
    const DIRECTION_DOWN = 2;
    const DIRECTION_LEFT = 4;
    const DIRECTION_RIGHT = 6;
    const DIRECTION_UP = 8;

    public function getName(): string
    {
        return 'Scroll Map';
    }

    public function getDirection(): int
    {
        return $this->getParameter(0);
    }

    public function getDistance(): int
    {
        return $this->getParameter(1);
    }

    public function getSpeed(): int
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        switch ($this->getDirection()) {
            case self::DIRECTION_DOWN:
                $str = 'Down';
                break;
            case self::DIRECTION_LEFT:
                $str = 'Left';
                break;
            case self::DIRECTION_RIGHT:
                $str = 'Right';
                break;
            case self::DIRECTION_UP:
                $str = 'Up';
                break;
            default:
                throw new \Exception("Unknown direction '{$this->getDirection()}'");
        }

        $str .= ", {$this->getDistance()}, {$this->getSpeed()}";

        return $str;
    }
}
