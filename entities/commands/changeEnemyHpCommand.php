<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class changeEnemyHpCommand
 *
 * 0 - enemy id, -1 - all, others - enemy id starting from 0
 * 1 - op, 0 - add, 1 - sub
 * 2 - 0 - by constant, 1 - by variable
 * 3 - constant or variable
 * 4 - allow knockout true/false
 *
 * @package mh\entities\commands
 */
class changeEnemyHpCommand extends abstractCommand
{
    const OPERATOR_INCREASE = 0;
    const OPERATOR_DECREASE = 1;

    const OPERAND_CONSTANT = 0;
    const OPERAND_VARIABLE = 1;

    public function getEnemy(): int
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

    public function getAllowKnockout(): bool
    {
        return $this->getParameter(4);
    }

    function getName(): string
    {
        return 'Change enemy HP';
    }

    public function getParametersDescription(): string
    {
        $source = $this->getEnemy();
        if ($source == 0) {
            $str = "Entire troop";
        } else {
            $str = "#{$source}";
        }

        $str .= ', ';

        switch ($this->getOperator()) {
            case self::OPERATOR_INCREASE:
                $str .= '+';
                break;
            case self::OPERATOR_DECREASE:
                $str .= '-';
                break;
            default:
                throw new \Exception("Unknown modify enemy hp operator type '{$this->getOperator()}'");
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
                throw new \Exception("Unknown modify enemy hp operand type '{$this->getOperandType()}'");
        }

        if ($this->getAllowKnockout()) {
            $str .= ' (Allow Knockout)';
        }

        return $str;
    }
}
