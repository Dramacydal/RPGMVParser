<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTurn180DegreesCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTurn180DegreesCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Turn 180°';
    }
}
