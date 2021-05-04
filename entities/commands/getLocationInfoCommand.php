<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class getLocationInfoCommand
 *
 * 0 - variable id
 * 1 - info type
 * 2 - 0 - direct, 1 - by variables
 * 3 - curr map X or var X
 * 4 - curr map Y or var Y
 *
 * @package mh\entities\commands
 */
class getLocationInfoCommand extends abstractCommand
{
    const DESIGNATION_TYPE_DIRECT       = 0;
    const DESIGNATION_TYPE_BY_VARIABLES = 1;

    public function getVariable(): int
    {
        return $this->getParameter(0);
    }

    public function getInfoType(): int
    {
        return $this->getParameter(1);
    }

    public function getDesignationType(): int
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
        return 'Get Location Info';
    }

    public function getParametersDescription(): string
    {
        $str = "#{$this->getVariable()}";
        if ($variableName = $this->getP()->getVariable($this->getVariable())) {
            $str .= " {$variableName}";
        }

        $str .= ", Type {$this->getInfoType()}, ";

        switch ($this->getDesignationType()) {
            case self::DESIGNATION_TYPE_DIRECT:
                $str .= "({$this->getX()},{$this->getY()})";
                break;
            case self::DESIGNATION_TYPE_BY_VARIABLES:
                $str .= '({#' . $this->getX();
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
                throw new \Exception("Unknown get location info designation type '{$this->getDesignationType()}'");
        }

        return $str;
    }
}
