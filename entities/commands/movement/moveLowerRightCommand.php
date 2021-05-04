<?php

namespace rp\entities\commands\movement;

/**
 * Class moveLowerRightCommand
 *
 * @package mh\entities\commands\movement
 */
class moveLowerRightCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Move Lower Right';
    }
}
