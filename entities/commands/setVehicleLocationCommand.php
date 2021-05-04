<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class setVehicleLocationCommand
 *
 * 0 - veh id
 * 1 - 0 direct, 1 - by var
 * 2 - map id (var or constant)
 * 3 - x (var or constant)
 * 4 - y (var or constant)
 *
 * @package mh\entities\commands
 */
class setVehicleLocationCommand extends abstractCommand
{
    const TRANSFER_DIRECT      = 0;
    const TRANSFER_BY_VARIABLE = 1;

    public function getVehicle(): int
    {
        return $this->getParameter(0);
    }

    public function getTransferType(): int
    {
        return $this->getParameter(1);
    }

    public function getMap(): int
    {
        return $this->getParameter(2);
    }

    public function getX(): int
    {
        return $this->getParameter(3);
    }

    public function getY(): int
    {
        return $this->getParameter(4);
    }

    function getName(): string
    {
        return 'Set Vehicle Location';
    }

    public function getParametersDescription(): string
    {
        $str = "#{$this->getVehicle()}, ";

        switch ($this->getTransferType())
        {
            case self::TRANSFER_DIRECT:
                $str .= "#{$this->getMap()} ";
                if ($mapInfo = $this->getP()->getMapInfo($this->getMap()))
                    $str .= " '{$mapInfo['name']}' ";
                $str .= "({$this->getX()},{$this->getY()}";
                break;
            case self::TRANSFER_BY_VARIABLE:
                $str .= '{#' . $this->getMap();
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
                throw new \Exception("Unknown set vehicle location transfer type '{$this->getTransferType()}'");
        }

        return $str;
    }
}