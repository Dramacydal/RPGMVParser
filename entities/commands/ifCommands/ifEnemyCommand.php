<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifEnemyCommand
 *
 *      [1] - enemy id
 *      [2] - check type
 *          0 - appeared (none params)
 *          1 - state check
 *            [3] - state id
 *
 * @package mh\entities\commands\ifCommands
 */
class ifEnemyCommand extends ifCommand
{
    const CHECK_APPEARED = 0;
    const CHECK_STATE    = 1;

    public function getEnemyId(): int
    {
        return $this->getParameter(1);
    }

    public function getCheckType(): int
    {
        return $this->getParameter(2);
    }

    public function getCheckParameter()
    {
        return $this->getParameter(3);
    }

    public function getParametersDescription(): string
    {
        $str = "Enemy #{$this->getEnemyId()}";

        switch ($this->getCheckType()) {
            case self::CHECK_APPEARED:
                $str .= ' is appeared';
                break;
            case self::CHECK_STATE:
                $str .= " is affected by #{$this->getCheckParameter()} state";
                break;
            default:
                throw new \Exception("Unknown check type '{$this->getCheckType()}' for '{$this->getName()}' enemy command");
        }

        return $str;
    }
}
