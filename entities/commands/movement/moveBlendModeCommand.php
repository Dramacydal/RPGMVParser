<?php

namespace rp\entities\commands\movement;

/**
 * Class moveBlendModeCommand
 *
 * @package mh\entities\commands\movement
 */
class moveBlendModeCommand extends abstractMoveCommand
{
    const BLEND_NORMAL = 0;
    const BLEND_ADDITIVE = 1;

    function getName(): string
    {
        return 'Blend Mode';
    }

    public function getBlendMode(): int
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        switch($this->getBlendMode()) {
            case self::BLEND_NORMAL:
                return 'Normal';
            case self::BLEND_ADDITIVE:
                return 'Additive';
            default:
                throw new \Exception("Unknown blend mode {$this->getBlendMode()}");
        }
    }
}
