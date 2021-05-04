<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTurnTowardPlayerCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTurnTowardPlayerCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Turn toward Player';
    }
}
