<?php

namespace rp\entities\commands\movement;

/**
 * Class moveAtRandomCommand
 *
 * @package mh\entities\commands\movement
 */
class moveAtRandomCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Move at Random';
    }
}
