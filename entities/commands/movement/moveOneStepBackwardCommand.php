<?php

namespace rp\entities\commands\movement;

/**
 * Class moveOneStepBackwardCommand
 *
 * @package mh\entities\commands\movement
 */
class moveOneStepBackwardCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return '1 Step Backward';
    }
}
