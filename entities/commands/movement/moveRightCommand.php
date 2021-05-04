<?php

namespace rp\entities\commands\movement;

/**
 * Class moveRightCommand
 *
 * @package mh\entities\commands\movement
 */
class moveRightCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Move Right';
    }
}
