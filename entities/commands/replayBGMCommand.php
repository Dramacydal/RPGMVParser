<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class replayBGMCommand
 *
 * @package mh\entities\commands
 */
class replayBGMCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Replay BGM';
    }
}
