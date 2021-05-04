<?php

namespace rp\entities\commands\movement;

/**
 * Class moveLowerLeftCommand
 *
 * @package mh\entities\commands\movement
 */
class moveLowerLeftCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Move Lower Left';
    }
}
