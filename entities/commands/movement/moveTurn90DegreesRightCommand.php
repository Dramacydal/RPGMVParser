<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTurn90DegreesRightCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTurn90DegreesRightCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Turn 90° Right';
    }
}
