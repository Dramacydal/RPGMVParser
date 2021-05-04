<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class changeParameterCommand
 *
 * 0 - 0 - fixed actor, 1 - actor from variable
 * 1 - actor id or variable id
 * 2 - parameter id
 * 3 - op, 0 - add, 1 - sub
 * 4 - 0 - by constant, 1 - by variable
 * 5 - constant or variable id
 *
 * @package mh\entities\commands
 */
class changeParameterCommand extends abstractCommand
{
    const SOURCE_TYPE_ACTOR = 0;
    const SOURCE_TYPE_VARIABLE = 1;

    const OPERATOR_INCREASE = 0;
    const OPERATOR_DECREASE = 1;

    const OPERAND_CONSTANT = 0;
    const OPERAND_VARIABLE = 1;

    public function getSourceType(): int
    {
        return $this->getParameter(0);
    }

    public function getSource(): int
    {
        return $this->getParameter(1);
    }

    public function getActionParameter(): int
    {
        return $this->getParameter(2);
    }

    public function getOperator(): int
    {
        return $this->getParameter(3);
    }

    public function getOperandType(): int
    {
        return $this->getParameter(4);
    }

    public function getOperand(): int
    {
        return $this->getParameter(5);
    }

    function getName(): string
    {
        return 'Change parameter';
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
                throw new \Exception("Unknown change parameter source type '{$this->getSourceType()}'");
        }

        $str .= ", #{$this->getActionParameter()} ";

        switch ($this->getOperator()) {
            case self::OPERATOR_INCREASE:
                $str .= '+';
                break;
            case self::OPERATOR_DECREASE:
                $str .= '-';
                break;
            default:
                throw new \Exception("Unknown change parameter operator type '{$this->getOperator()}'");
        }

        $str .= ' ';

        switch ($this->getOperandType()) {
            case self::OPERAND_CONSTANT:
                $str .= $this->getOperand();
                break;
            case self::OPERAND_VARIABLE:
                $str .= '{#' . $this->getOperand();
                if ($variableName = $this->getP()->getVariable($this->getOperand())) {
                    $str .= " {$variableName}";
                }
                $str .= '}';
                break;
            default:
                throw new \Exception("Unknown change parameter operand type '{$this->getOperandType()}'");
        }

        return $str;
    }
}
