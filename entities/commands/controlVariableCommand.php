<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class controlVariableCommand
 *
 * 0 - start var
 * 1 - end var
 * 2 - operator, 0 - set, 1 - add, 2 - dec, 3 - mult, 4 - div, 5 - mod
 * 3 - operand is
 *      0 - constant
 *          4 - value
 *      1 - variable
 *          4 - variable id
 *      2 - random range
 *          4 - range min
 *          5 - range max
 *      3 - game data
 *          ...
 *      4 - scenario
 *          4 - scenario text
 *
 *
 * @package mh\entities\commands
 */
class controlVariableCommand extends abstractCommand
{
    const OPERATOR_SET = 0;
    const OPERATOR_ADD = 1;
    const OPERATOR_DEC = 2;
    const OPERATOR_MUL = 3;
    const OPERATOR_DIV = 4;
    const OPERATOR_MOD = 5;

    const OPERAND_CONSTANT  = 0;
    const OPERAND_VARIABLE  = 1;
    const OPERAND_RANDOM    = 2;
    const OPERAND_GAME_DATA = 3;
    const OPERAND_SCENARIO  = 4;

    public function getStartVariable(): int
    {
        return $this->getParameter(0);
    }

    public function getEndVariable(): int
    {
        return $this->getParameter(1);
    }

    public function getOperator(): int
    {
        return $this->getParameter(2);
    }

    public function getOperandType(): int
    {
        return $this->getParameter(3);
    }

    public function getOperand1()
    {
        return $this->getParameter(4);
    }

    public function getOperand2()
    {
        return $this->getParameter(5);
    }

    public function getName(): string
    {
        return 'Control variable';
    }

    public function getParametersDescription(): string
    {
        if ($this->getStartVariable() != $this->getEndVariable()) {
            $str = "#{$this->getStartVariable()}..{$this->getEndVariable()}";
        } else {
            $str = "#{$this->getStartVariable()}";
            if ($variableName = $this->getP()->getVariable($this->getStartVariable())) {
                $str .= " {$variableName}";
            }
        }
        switch ($this->getOperator()) {
            case self::OPERATOR_SET:
                $str .= ' =';
                break;
            case self::OPERATOR_ADD:
                $str .= ' +=';
                break;
            case self::OPERATOR_DEC:
                $str .= ' -=';
                break;
            case self::OPERATOR_MUL:
                $str .= ' *=';
                break;
            case self::OPERATOR_DIV:
                $str .= ' /=';
                break;
            case self::OPERATOR_MOD:
                $str .= ' %=';
                break;
            default:
                throw new \Exception("Unknown operator type #{$this->getOperator()} for action #{$this->getCode()} {$this->getName()}");
        }

        switch ($this->getOperandType()) {
            case self::OPERAND_CONSTANT:
                $str .= " {$this->getOperand1()}";
                break;
            case self::OPERAND_VARIABLE:
                $str .= '{#' . $this->getOperand1();
                if ($variableName = $this->getP()->getVariable($this->getOperand1())) {
                    $str .= " {$variableName}";
                }
                $str .= '}';
                break;
            case self::OPERAND_RANDOM:
                $str .= " Random ({$this->getOperand1()}, {$this->getOperand2()})";
                break;
            case self::OPERAND_GAME_DATA:
                $str .= " Game data ({$this->getOperand1()}, {$this->getOperand2()})";
                break;
            case self::OPERAND_SCENARIO:
                $str .= " Scenario ('{$this->getOperand1()}', '{$this->getOperand2()}')";
                break;
            default:
                throw new \Exception("Unknown operator type #{$this->getOperator()} for action #{$this->getCode()} {$this->getName()}");
        }

        return $str;
    }
}