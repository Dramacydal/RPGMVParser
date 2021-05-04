<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class fadeoutScreenCommand
 *
 * @package mh\entities\commands
 */
class fadeoutScreenCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Fadeout Screen';
    }
}
