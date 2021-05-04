<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class changeArmorsCommand
 *
 * 0 - armor id
 * 1 - 0 - add, 1 - dec
 * 2 - 0 - by value, 1- by var
 * 3 - value or var id
 * 4 - include equipment
 *
 * @package mh\entities\commands
 */
class changeArmorsCommand extends abstractCommand
{
    const OPERATOR_ADD = 0;
    const OPERATOR_TAKE = 1;

    const OPERAND_CONSTANT = 0;
    const OPERAND_VARIABLE = 1;

    public function getArmor(): int
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

    public function getIncludeEquipment(): bool
    {
        return $this->getParameter(4);
    }

    function getName(): string
    {
        return 'Change armors';
    }

    public function getParametersDescription(): string
    {
        $str = "#{$this->getArmor()} ";

        switch ($this->getOperator()) {
            case self::OPERATOR_ADD:
                $str .= '+';
                break;
            case self::OPERATOR_TAKE:
                $str .= '-';
                break;
            default:
                throw new \Exception("Unknown change armors operator type '{$this->getOperator()}'");
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
                throw new \Exception("Unknown change armors operand type '{$this->getOperandType()}'");
        }

        if ($this->getIncludeEquipment()) {
            $str .= ' (Include Equipment)';
        }

        return $str;
    }
}
