<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class exitEventProcessingCommand
 *
 * @package mh\entities\commands
 */
class exitEventProcessingCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Exit Event Processing';
    }
}
