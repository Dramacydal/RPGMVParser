<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTurnAtRandomCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTurnAtRandomCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Turn at Random';
    }
}
