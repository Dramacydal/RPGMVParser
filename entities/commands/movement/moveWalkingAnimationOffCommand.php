<?php

namespace rp\entities\commands\movement;

/**
 * Class moveWalkingAnimationOffCommand
 *
 * @package mh\entities\commands\movement
 */
class moveWalkingAnimationOffCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Walking Animation OFF';
    }
}
