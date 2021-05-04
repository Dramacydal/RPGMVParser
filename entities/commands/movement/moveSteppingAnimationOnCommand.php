<?php

namespace rp\entities\commands\movement;

/**
 * Class moveSteppingAnimationOnCommand
 *
 * @package mh\entities\commands\movement
 */
class moveSteppingAnimationOnCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Stepping Animation ON';
    }
}
