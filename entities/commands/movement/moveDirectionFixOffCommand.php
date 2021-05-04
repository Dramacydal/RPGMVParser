<?php

namespace rp\entities\commands\movement;

/**
 * Class moveDirectionFixOffCommand
 *
 * @package mh\entities\commands\movement
 */
class moveDirectionFixOffCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Direction Fix OFF';
    }
}
