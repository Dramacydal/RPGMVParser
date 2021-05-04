<?php

namespace rp\entities\commands\movement;

/**
 * Class moveOneStepForwardCommand
 *
 * @package mh\entities\commands\movement
 */
class moveOneStepForwardCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return '1 Step Forward';
    }
}
