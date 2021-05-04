<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class recoverAllCommand
 *
 * 0 - 0 - fixed actor, 1 - actor from variable
 * 1 - party id (0 - Entire party) or variable id
 *
 * @package mh\entities\commands
 */
class recoverAllCommand extends abstractCommand
{
    const SOURCE_TYPE_ACTOR = 0;
    const SOURCE_TYPE_VARIABLE = 1;

    public function getSourceType(): int
    {
        return $this->getParameter(0);
    }

    public function getSource(): int
    {
        return $this->getParameter(1);
    }

    function getName(): string
    {
        return 'Recover all';
    }

    public function getParametersDescription(): string
    {
        $source = $this->getSource();
        switch ($this->getSourceType()) {
            case self::SOURCE_TYPE_ACTOR:
                if ($source == 0) {
                    $str = "Entire party";
                } else {
                    $str = "#{$this->getSource()}";
                }
                break;
            case self::SOURCE_TYPE_VARIABLE:
                $str = '{#' . $source;
                if ($variableName = $this->getP()->getVariable($source))
                    $str .= " {$variableName}";
                $str .= '}';
                break;
            default:
                throw new \Exception("Unknown recover all source type '{$this->getSourceType()}'");
        }

        return $str;
    }
}
