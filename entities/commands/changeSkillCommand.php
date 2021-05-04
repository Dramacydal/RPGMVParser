<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class changeSkillCommand
 *
 * 0 - 0 - fixed actor, 1 - actor from variable
 * 1 - actor id or variable id
 * 2 - 0 - add, 1 - take
 * 3 - ability id
 *
 *
 * @package mh\entities\commands
 */
class changeSkillCommand extends abstractCommand
{
    const SOURCE_TYPE_ACTOR = 0;
    const SOURCE_TYPE_VARIABLE = 1;

    const OPERATOR_LEARN  = 0;
    const OPERATOR_FORGET = 1;

    public function getSourceType(): int
    {
        return $this->getParameter(0);
    }

    public function getSource(): int
    {
        return $this->getParameter(1);
    }

    public function getOperator(): int
    {
        return $this->getParameter(2);
    }

    public function getSkill(): int
    {
        return $this->getParameter(3);
    }

    function getName(): string
    {
        return 'Change skill';
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
                throw new \Exception("Unknown change skill source type '{$this->getSourceType()}'");
        }

        switch ($this->getOperator()) {
            case self::OPERATOR_LEARN:
                $str .= '+';
                break;
            case self::OPERATOR_FORGET:
                $str .= '-';
                break;
            default:
                throw new \Exception("Unknown change skill operator type '{$this->getOperator()}'");
        }

        $str .= " #{$this->getSkill()}";

        return $str;
    }
}
