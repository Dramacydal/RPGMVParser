<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifSwitchCommand
 *
 *      [1] - variable id
 *      [2] - operand type, 0 - constant, 1 - variable
 *      [3] - constant or variable id
 *      [4] - operator, 0 - eq, 1 - gte, 2 - lte, 3 - gt, 4 - lt, 5 - neq
 *
 * @package mh\entities\commands\ifCommands
 */
class ifVariableCommand extends ifCommand
{
    const OPERATOR_EQ  = 0;
    const OPERATOR_GTE = 1;
    const OPERATOR_LTE = 2;
    const OPERATOR_GT  = 3;
    const OPERATOR_LT  = 4;
    const OPERATOR_NEQ = 5;

    const OPERAND_CONSTANT  = 0;
    const OPERAND_VARIABLE  = 1;

    public function getVariable(): int
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

    public function getOperator(): int
    {
        return $this->getParameter(4);
    }

    public function setVariable(int $value)
    {
        $this->setParameter(1, $value);
    }

    public function setOperand(int $value)
    {
        $this->setParameter(3, $value);
    }

    public function getParametersDescription(): string
    {
        $str = "#{$this->getVariable()}";
        if ($variableName = $this->getP()->getVariable($this->getVariable())) {
            $str .= " {$variableName}";
        }

        switch ($this->getOperator()) {
            case self::OPERATOR_EQ:
                $str .= ' = ';
                break;
            case self::OPERATOR_GTE:
                $str .= ' >= ';
                break;
            case self::OPERATOR_LTE:
                $str .= ' <= ';
                break;
            case self::OPERATOR_GT:
                $str .= ' > ';
                break;
            case self::OPERATOR_LT:
                $str .= ' < ';
                break;
            case self::OPERATOR_NEQ:
                $str .= ' != ';
                break;
            default:
                throw new \Exception("Unknown operator type {$this->getOperator()} for '{$this->getName()}' variable command");
        }

        switch ($this->getOperandType()) {
            case self::OPERAND_CONSTANT:
                $str .= $this->getOperand();
                break;
            case self::OPERAND_VARIABLE:
                $str .= '#{' . $this->getOperand();
                if ($variableName = $this->getP()->getVariable($this->getOperand())) {
                    $str .= " {$variableName}";
                }
                $str .= '}';
                break;
            default:
                throw new \Exception("Unknown operand type '{$this->getOperandType()}' for '{$this->getName()}' variable command");
        }

        return $str;
    }
}
