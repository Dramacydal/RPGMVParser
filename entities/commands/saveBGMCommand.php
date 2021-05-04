<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class saveBGMCommand
 *
 * @package mh\entities\commands
 */
class saveBGMCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Save BGM';
    }
}
