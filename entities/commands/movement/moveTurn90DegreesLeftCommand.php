<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTurn90DegreesLeftCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTurn90DegreesLeftCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Turn 90° Left';
    }
}
