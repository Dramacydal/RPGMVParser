<?php

namespace rp\entities\commands\movement;

/**
 * Class moveEmptyCommand
 *
 * @package mh\entities\commands\movement
 */
class moveEmptyCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Empty';
    }
}