<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class showAnimationCommand
 *
 * @package mh\entities\commands
 */
class showAnimationCommand extends abstractCommand
{
    const ACTOR_PLAYER = -1;
    const ACTOR_THIS_EVENT = 0;

    function getName(): string
    {
        return 'Show Animation';
    }

    function getActor(): int
    {
        return $this->getParameter(0);
    }

    function getAnimation(): int
    {
        return $this->getParameter(1);
    }

    function getWaitForCompletion(): bool
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        switch ($this->getActor()) {
            case self::ACTOR_PLAYER:
                $str = 'Player';
                break;
            case self::ACTOR_THIS_EVENT:
                $str = 'This Event';
                break;
            default:
                $str = "Event #{$this->getActor()}";
                break;
        }


        if ($animation = $this->getP()->getAnimation($this->getAnimation()))
            $str .= ', ' . $animation['name'];
        else
            $str .= ", Animation #{$this->getAnimation()}";

        if ($this->getWaitForCompletion())
            $str .= ' (Wait)';

        return $str;
    }
}
