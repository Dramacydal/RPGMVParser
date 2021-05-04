<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifGoldCommand
 *
 *      [1] - amount
 *      [2] - operator, 0 - gte, 1 - lte, 2 - lt
 *
 * @package mh\entities\commands\ifCommands
 */
class ifGoldCommand extends ifCommand
{
    const OPERATOR_GTE = 0;
    const OPERATOR_LTE = 1;
    const OPERATOR_LT  = 2;

    public function getAmount(): int
    {
        return $this->getParameter(1);
    }

    public function getOperator(): int
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        $str = 'Gold ';

        switch ($this->getOperator()) {
            case self::OPERATOR_GTE:
                $str .= '>=';
                break;
            case self::OPERATOR_LTE:
                $str .= '<=';
                break;
            case self::OPERATOR_LT:
                $str .= '<';
                break;
            default:
                throw new \Exception("Unknown operator '{$this->getOperator()}' for '{$this->getName()}' gold command");
        }

        $str .= " {$this->getAmount()}";

        return $str;
    }
}
