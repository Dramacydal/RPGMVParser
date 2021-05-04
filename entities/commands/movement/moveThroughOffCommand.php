<?php

namespace rp\entities\commands\movement;

/**
 * Class moveThroughOffCommand
 *
 * @package mh\entities\commands\movement
 */
class moveThroughOffCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Through OFF';
    }
}
