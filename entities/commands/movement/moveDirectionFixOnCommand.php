<?php

namespace rp\entities\commands\movement;

/**
 * Class moveDirectionFixOnCommand
 *
 * @package mh\entities\commands\movement
 */
class moveDirectionFixOnCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Direction Fix ON';
    }
}
