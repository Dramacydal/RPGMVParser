<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class modifyGoldAction
 *
 * 0 - 0 - increase, 1 - decrease
 * 1 - 0 - by amount, 1 - by variable
 * 2 - value or variable id
 *
 * @package mh\entities\commands
 */
class changeGoldCommand extends abstractCommand
{
    const OPERATOR_ADD = 0;
    const OPERATOR_TAKE = 1;

    const OPERAND_CONSTANT = 0;
    const OPERAND_VARIABLE = 1;

    public function getOperator(): int
    {
        return $this->getParameter(0);
    }

    public function getOperandType(): int
    {
        return $this->getParameter(1);
    }

    public function getOperand(): int
    {
        return $this->getParameter(2);
    }

    function getName(): string
    {
        return 'Change gold';
    }

    public function getParametersDescription(): string
    {
        switch ($this->getOperator()) {
            case self::OPERATOR_ADD:
                $str = '+';
                break;
            case self::OPERATOR_TAKE:
                $str = '-';
                break;
            default:
                throw new \Exception("Unknown modify gold operator type '{$this->getOperator()}'");
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
                throw new \Exception("Unknown modify gold operand type '{$this->getOperandType()}'");
        }

        return $str;
    }
}
