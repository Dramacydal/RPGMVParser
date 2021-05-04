<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class setEventLocationCommand
 *
 * 0 - event id (0 - self)
 * 1 - 0 direct, 1 - by var, 2 - swap with another
 * 2 - x value, x var or other event id
 * 3 - y value, y var or 0
 * 4 - direction
 *
 * @package mh\entities\commands
 */
class setEventLocationCommand extends abstractCommand
{
    const TRANSFER_DIRECT      = 0;
    const TRANSFER_BY_VARIABLE   = 1;
    const TRANSFER_TYPE_EXCHANGE = 2;

    public function getEvent(): int
    {
        return $this->getParameter(0);
    }

    public function getTransferType(): int
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

    function getName(): string
    {
        return 'Set Event Location';
    }

    public function getParametersDescription(): string
    {
        if ($this->getEvent() == 0) {
            $str = "This event";
        } else {
            $str = "#{$this->getEvent()}";
        }

        $str .= ', ';

        switch ($this->getTransferType()) {
            case self::TRANSFER_DIRECT:
                $str .= "({$this->getX()},{$this->getY()}";
                break;
            case self::TRANSFER_BY_VARIABLE:
                $str .= '(';
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
            case self::TRANSFER_TYPE_EXCHANGE:
                $str .= "Exchange with #{$this->getX()}";
                break;
            default:
                throw new \Exception("Unknown set event location transfer type '{$this->getTransferType()}'");
        }

        $str .= " (Direction: {$this->getDirection()}";

        return $str;
    }
}