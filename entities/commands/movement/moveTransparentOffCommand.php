<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTransparentOffCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTransparentOffCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Transparent OFF';
    }
}
