<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTurnLeftCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTurnLeftCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Turn Left';
    }
}
