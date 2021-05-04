<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTurn90DegreesRightOrLeftCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTurn90DegreesRightOrLeftCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Turn 90° Right or Left';
    }
}
