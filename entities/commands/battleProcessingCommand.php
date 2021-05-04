<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class battleProcessingCommand
 *
 * 0 - type, 0 - battle id, 1 - by variable, 2 - random analog (tf?)
 * 1 - battle id or variable id
 * 2 - can run away true/false
 * 3 - can lose true/false
 *
 * @package mh\entities\commands
 */
class battleProcessingCommand extends abstractCommand
{
    const DESIGNATION_TYPE_DIRECT                   = 0;
    const DESIGNATION_TYPE_BY_VARIABLE              = 1;
    const DESIGNATION_TYPE_SAME_AS_RANDOM_ENCOUNTER = 2;

    public function getDesignationType(): int
    {
        return $this->getParameter(0);
    }

    public function getBattle(): int
    {
        return $this->getParameter(1);
    }

    public function getCanRunAway(): bool
    {
        return $this->getParameter(2);
    }

    public function getCanLose(): bool
    {
        return $this->getParameter(3);
    }

    function getName(): string
    {
        return 'Battle processing';
    }

    public function getParametersDescription(): string
    {
        $source = $this->getBattle();
        switch ($this->getDesignationType()) {
            case self::DESIGNATION_TYPE_DIRECT:
                $str = "#{$source}";
                break;
            case self::DESIGNATION_TYPE_BY_VARIABLE:
                $str = '{#' . $source;
                if ($variableName = $this->getP()->getVariable($source)) {
                    $str .= " {$variableName}";
                }
                $str .= '}';
                break;
            case self::DESIGNATION_TYPE_SAME_AS_RANDOM_ENCOUNTER:
                $str = "Same as Random Encounter";
                break;
            default:
                throw new \Exception("Unknown battle processing designation type '{$this->getDesignationType()}'");
        }

        if ($this->getCanRunAway()) {
            $str .= ", Can run away";
        }

        if ($this->getCanLose()) {
            $str .= ", Can lose";
        }

        return $str;
    }
}
