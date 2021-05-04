<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifTimerCommand
 *
 *      [1] - seconds count
 *      [2] - comp, 0 - gte, 1 - lte
 *
 * @package mh\entities\commands\ifCommands
 */
class ifTimerCommand extends ifCommand
{
    const OPERATOR_GTE = 0;
    const OPERATOR_LTE = 1;

    public function getSeconds(): int
    {
        return $this->getParameter(1);
    }

    public function getOperator(): int
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        $str = 'Timer ';

        switch ($this->getOperator()) {
            case self::OPERATOR_GTE:
                $str .= '>=';
                break;
            case self::OPERATOR_LTE:
                $str .= '<=';
                break;
            default:
                throw new \Exception("Unknown operator '{$this->getOperator()}' for '{$this->getName()}' timer command");
        }

        $str .= "{$this->getSeconds()} sec";

        return $str;
    }
}
