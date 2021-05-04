<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class fadeinScreenCommand
 *
 * @package mh\entities\commands
 */
class fadeinScreenCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Fadein Screen';
    }
}
