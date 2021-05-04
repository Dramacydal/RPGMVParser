<?php

namespace rp\entities\commands\movement;

/**
 * Class moveWalkingAnimationOnCommand
 *
 * @package mh\entities\commands\movement
 */
class moveWalkingAnimationOnCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Walking Animation ON';
    }
}
