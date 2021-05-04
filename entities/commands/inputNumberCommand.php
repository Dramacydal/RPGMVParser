<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class inputNumberCommand
 *
 * 0 - variable id
 * 1 - digits count
 *
 * @package mh\entities\commands
 */
class inputNumberCommand extends abstractCommand
{
    public function getVariable(): int
    {
        return $this->getParameter(0);
    }

    public function getDigitsCount(): int
    {
        return $this->getParameter(1);
    }

    function getName(): string
    {
        return 'Input number';
    }

    public function getParametersDescription(): string
    {
        $str = "#{$this->getVariable()}";
        if ($variableName = $this->getP()->getVariable($this->getVariable())) {
            $str .= " {$variableName}";
        }

        $str .= ", {$this->getDigitsCount()} digits";

        return $str;
    }
}
