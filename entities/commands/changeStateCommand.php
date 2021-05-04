<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class changeStateCommand
 *
 * 0 - 0 - fixed actor, 1 - actor from variable
 * 1 - party id (0 - Entire party) or variable id
 * 2 - 0 - add, 1 - remove
 * 3 - state id
 *
 * @package mh\entities\commands
 */
class changeStateCommand extends abstractCommand
{
    const SOURCE_TYPE_ACTOR = 0;
    const SOURCE_TYPE_VARIABLE = 1;

    const OPERATOR_ADD    = 0;
    const OPERATOR_REMOVE = 1;

    public function getSourceType(): int
    {
        return $this->getParameter(0);
    }

    public function getSource(): int
    {
        return $this->getParameter(1);
    }

    public function getOperator(): int
    {
        return $this->getParameter(2);
    }

    public function getState(): int
    {
        return $this->getParameter(3);
    }

    function getName(): string
    {
        return 'Change state';
    }

    public function getParametersDescription(): string
    {
        $source = $this->getSource();
        switch ($this->getSourceType()) {
            case self::SOURCE_TYPE_ACTOR:
                if ($source == 0) {
                    $str = "Entire party";
                } else {
                    $str = "#{$this->getSource()}";
                }
                break;
            case self::SOURCE_TYPE_VARIABLE:
                $str = '{#' . $source;
                if ($variableName = $this->getP()->getVariable($source))
                    $str .= " {$variableName}";
                $str .= '}';
                break;
            default:
                throw new \Exception("Unknown modify state source type '{$this->getSourceType()}'");
        }

        $str .= ', ';

        switch ($this->getOperator()) {
            case self::OPERATOR_ADD:
                $str .= '+';
                break;
            case self::OPERATOR_REMOVE:
                $str .= '-';
                break;
            default:
                throw new \Exception("Unknown modify state operator type '{$this->getOperator()}'");
        }

        $str .= " #{$this->getState()}";

        return $str;
    }
}
