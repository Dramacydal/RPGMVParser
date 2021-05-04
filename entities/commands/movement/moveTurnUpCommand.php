<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTurnUpCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTurnUpCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Turn Up';
    }
}
