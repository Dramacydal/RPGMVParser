<?php

namespace rp\entities\commands\movement;

/**
 * Class moveUpperRightCommand
 *
 * @package mh\entities\commands\movement
 */
class moveUpperRightCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Move Upper Right';
    }
}
