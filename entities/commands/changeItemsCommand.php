<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class changeItemsCommand
 *
 * 0 - item id
 * 1 - 0 - add, 1 - dec
 * 2 - 0 - by value, 1- by var
 * 3 - value or var id
 *
 * @package mh\entities\commands
 */
class changeItemsCommand extends abstractCommand
{
    const OPERATOR_ADD = 0;
    const OPERATOR_TAKE = 1;

    const OPERAND_CONSTANT = 0;
    const OPERAND_VARIABLE = 1;

    public function getItem(): int
    {
        return $this->getParameter(0);
    }

    public function getOperator(): int
    {
        return $this->getParameter(1);
    }

    public function getOperandType(): int
    {
        return $this->getParameter(2);
    }

    public function getOperand(): int
    {
        return $this->getParameter(3);
    }

    function getName(): string
    {
        return 'Change items';
    }

    public function getParametersDescription(): string
    {
        $str = "#{$this->getItem()} ";

        switch ($this->getOperator()) {
            case self::OPERATOR_ADD:
                $str .= '+';
                break;
            case self::OPERATOR_TAKE:
                $str .= '-';
                break;
            default:
                throw new \Exception("Unknown change items operator type '{$this->getOperator()}'");
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
                throw new \Exception("Unknown change items operand type '{$this->getOperandType()}'");
        }

        return $str;
    }
}
