<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifCharacterCommand
 *
 *      [1] - source type, -1 - player, 0 - this event, else event id
 *      [2] - orientation mask, 2 - down, 4 - left, 6 - right, 8 - up
 *
 * @package mh\entities\commands\ifCommands
 */
class ifCharacterCommand extends ifCommand
{
    const ORIENTATION_DOWN = 2;
    const ORIENTATION_LEFT = 4;
    const ORIENTATION_RIGHT = 6;
    const ORIENTATION_UP    = 8;

    public function getSourceType(): int
    {
        return $this->getParameter(1);
    }

    public function getOrientation(): int
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        switch ($this->getSourceType()) {
            case -1:
                $str = 'Player';
                break;
            case 0:
                $str = 'This Event';
                break;
            default:
                $str = "Event #{$this->getSourceType()}";
                break;
        }

        $str .= ' is facing ';
        switch ($this->getOrientation()) {
            case self::ORIENTATION_DOWN:
                $str .= 'Down';
                break;
            case self::ORIENTATION_LEFT:
                $str .= 'Left';
                break;
            case self::ORIENTATION_RIGHT:
                $str .= 'Right';
                break;
            case self::ORIENTATION_UP:
                $str .= 'Up';
                break;
            default:
                throw new \Exception("Unknown orientation '{$this->getOrientation()}' for '{$this->getName()}' orientation command");
        }

        return $str;
    }
}
