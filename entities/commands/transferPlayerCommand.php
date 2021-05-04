<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class transferPlayerCommand
 *
 * 0 - 0 direct, 1 - by var
 * 1 - map id (var or constant)
 * 2 - x (var or constant)
 * 3 - y (var or constant)
 * 4 - direction
 * 5 - fade (0 - black, 1 - white, 2? - none)
 *
 * @package mh\entities\commands
 */
class transferPlayerCommand extends abstractCommand
{
    const TRANSFER_DIRECT      = 0;
    const TRANSFER_BY_VARIABLE = 1;

    const DIRECTION_RETAIN = 0;
    const DIRECTION_DOWN = 2;
    const DIRECTION_LEFT = 4;
    const DIRECTION_RIGHT = 6;
    const DIRECTION_UP = 8;

    const FADE_BLACK = 0;
    const FADE_WHITE = 1;
    const FADE_NONE = 2;

    public function getTransferType(): int
    {
        return $this->getParameter(0);
    }

    public function getMap(): int
    {
        return $this->getParameter(1);
    }

    public function getX(): int
    {
        return $this->getParameter(2);
    }

    public function getY(): int
    {
        return $this->getParameter(3);
    }

    public function getDirection(): int
    {
        return $this->getParameter(4);
    }

    public function getFade(): int
    {
        return $this->getParameter(5);
    }

    function getName(): string
    {
        return 'Transfer player';
    }

    public function getParametersDescription(): string
    {
        switch ($this->getTransferType()) {
            case self::TRANSFER_DIRECT:
                $str = "#{$this->getMap()} ";
                if ($mapInfo = $this->getP()->getMapInfo($this->getMap())) {
                    $str .= " '{$mapInfo['name']}' ";
                }
                $str .= "({$this->getX()},{$this->getY()})";
                break;
            case self::TRANSFER_BY_VARIABLE:
                $str = '{#' . $this->getMap();
                if ($variableName = $this->getP()->getVariable($this->getMap())) {
                    $str .= ' ' . $variableName;
                }
                $str .= '} (';
                $str .= '{#' . $this->getX();
                if ($variableName = $this->getP()->getVariable($this->getX())) {
                    $str .= ' ' . $variableName;
                }
                $str .= '},';
                $str .= '{#' . $this->getY();
                if ($variableName = $this->getP()->getVariable($this->getY())) {
                    $str .= ' ' . $variableName;
                }
                $str .= '})';
                break;
            default:
                throw new \Exception("Unknown transfer player transfer type '{$this->getTransferType()}'");
        }

        $parts = [];
        if ($this->getDirection() != self::DIRECTION_RETAIN) {
            $direction = 'Direction: ';
            switch ($this->getDirection()) {
                case self::DIRECTION_DOWN:
                    $direction .= 'Down';
                    break;
                case self::DIRECTION_LEFT:
                    $direction .= 'Left';
                    break;
                case self::DIRECTION_RIGHT:
                    $direction .= 'Right';
                    break;
                case self::DIRECTION_UP:
                    $direction .= 'Up';
                    break;
                default:
                    throw new \Exception("Unknown direction '{$this->getDirection()}'");
            }

            $parts[] = $direction;
        }

        if ($this->getFade() != self::FADE_BLACK) {
            $fade = 'Fade: ';
            switch ($this->getFade()) {
                case self::FADE_WHITE:
                    $fade .= 'White';
                    break;
                case self::FADE_NONE:
                    $fade .= 'None';
                    break;
                default:
                    throw new \Exception("Unknown fade '{$this->getFade()}'");
            }

            $parts[] = $fade;
        }

        if (!empty($parts)) {
            $str .= ' (' . implode(', ', $parts) . ')';
        }

        return $str;
    }
}
