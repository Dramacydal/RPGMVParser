<?php

namespace rp\entities\commands\movement;

/**
 * Class moveLeftCommand
 *
 * @package mh\entities\commands\movement
 */
class moveLeftCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Move Left';
    }
}
