<?php

namespace rp\entities\commands\movement;

use rp\entities\abstractCommand;

/**
 * Class moveUpCommand
 *
 * @package mh\entities\commands\movement
 */
class moveUpCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Move Up';
    }
}
