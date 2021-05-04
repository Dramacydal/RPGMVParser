<?php

namespace rp\entities\commands\movement;

/**
 * Class moveThroughOnCommand
 *
 * @package mh\entities\commands\movement
 */
class moveThroughOnCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Through ON';
    }
}
