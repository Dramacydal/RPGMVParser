<?php

namespace rp\entities\commands\movement;

/**
 * Class moveSteppingAnimationOffCommand
 *
 * @package mh\entities\commands\movement
 */
class moveSteppingAnimationOffCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Stepping Animation OFF';
    }
}
