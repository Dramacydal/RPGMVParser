<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class selectItemCommand
 *
 * 0 - variable id
 * 1 - item type
 *
 * @package mh\entities\commands
 */
class selectItemCommand extends abstractCommand
{
    public function getVariable(): int
    {
        return $this->getParameter(0);
    }

    public function getItemType(): int
    {
        return $this->getParameter(1);
    }

    function getName(): string
    {
        return 'Select item';
    }

    public function getParametersDescription(): string
    {
        $str = "#{$this->getVariable()}";
        if ($variableName = $this->getP()->getVariable($this->getVariable())) {
            $str .= " {$variableName}";
        }

        $str .= ", item type #{$this->getItemType()}";

        return $str;
    }
}
