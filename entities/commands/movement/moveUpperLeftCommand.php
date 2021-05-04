<?php

namespace rp\entities\commands\movement;

/**
 * Class moveUpperLeftCommand
 *
 * @package mh\entities\commands\movement
 */
class moveUpperLeftCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Move Upper Left';
    }
}
