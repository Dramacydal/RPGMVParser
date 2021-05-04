<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTurnAwayFromPlayerCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTurnAwayFromPlayerCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Turn away from Player';
    }
}
