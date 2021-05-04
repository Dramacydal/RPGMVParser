<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTurnRightCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTurnRightCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Turn Right';
    }
}
