<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class showPictureCommand
 *
 * 0 - layer
 * 1 - image name
 * 2 - reference location, 0 - upperleft, 1 - center
 * 3 - 0 - direct, 1 - by variables
 * 4 - X or var X
 * 5 - Y or var Y
 * 6 - width
 * 7 - height
 * 8 - transparency
 * 9 - blend mode 0 - normal, 1 - add
 *
 * @package mh\entities\commands
 */
class showPictureCommand extends abstractCommand
{
    const REFERENCE_UPPERLEFT = 0;
    const REFERENCE_CENTER    = 1;

    const PLACE_DIRECT      = 0;
    const PLACE_BY_VARIABLE = 1;

    const BLEND_NORMAL   = 0;
    const BLEND_ADDITIVE = 1;

    public function getLayer(): int
    {
        return $this->getParameter(0);
    }

    public function getPicture(): string
    {
        return $this->getParameter(1);
    }

    public function getReference(): int
    {
        return $this->getParameter(2);
    }

    public function getPlaceType(): int
    {
        return $this->getParameter(3);
    }

    public function getX(): int
    {
        return $this->getParameter(4);
    }

    public function getY(): int
    {
        return $this->getParameter(5);
    }

    public function setY(int $value): void
    {
        $this->setParameter(5, $value);
    }

    public function getWidth(): int
    {
        return $this->getParameter(6);
    }

    public function getHeight(): int
    {
        return $this->getParameter(7);
    }

    public function getTransparency(): int
    {
        return $this->getParameter(8);
    }

    public function getBlendMode(): int
    {
        return $this->getParameter(9);
    }

    public function setLayer(int $value)
    {
        $this->setParameter(0, $value);
    }

    public function setPicture(string $value)
    {
        $this->setParameter(1, $value);
    }

    function getName(): string
    {
        return 'Show picture';
    }

    public function getParametersDescription(): string
    {
        $pictureName = $this->getPicture();
        if (empty($pictureName)) {
            $pictureName = 'None';
        }

        $str = "#{$this->getLayer()}, {$pictureName}, ";
        switch ($this->getReference()) {
            case self::REFERENCE_UPPERLEFT:
                $str .= 'Upper left';
                break;
            case self::REFERENCE_CENTER:
                $str .= 'Center';
                break;
            default:
                throw new \Exception("Unknown show picture reference type '{$this->getReference()}'");
        }

        switch ($this->getPlaceType()) {
            case self::PLACE_DIRECT:
                $str .= "({$this->getX()},{$this->getY()})";
                break;
            case self::PLACE_BY_VARIABLE:
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
                throw new \Exception("Unknown show picture place by type '{$this->getPlaceType()}'");
        }

        $str .= " ({$this->getWidth()}%,{$this->getHeight()}%), {$this->getTransparency()}, ";
        switch ($this->getBlendMode()) {
            case self::BLEND_NORMAL:
                $str .= 'Normal';
                break;
            case self::BLEND_ADDITIVE:
                $str .= 'Additive';
                break;
            default:
                throw new \Exception("Unknown show picture blend mode '{$this->getBlendMode()}'");
        }

        return $str;
    }
}
