<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class emptyCommand
 *
 * @package mh\entities\commands
 */
class emptyCommand extends abstractCommand
{
    function getName(): string
    {
        return '';
    }
}
