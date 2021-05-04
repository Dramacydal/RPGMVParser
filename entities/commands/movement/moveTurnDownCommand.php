<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTurnDownCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTurnDownCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Turn Down';
    }
}
