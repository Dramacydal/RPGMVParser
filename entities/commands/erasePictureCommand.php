<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class erasePictureCommand
 *
 * @package mh\entities\commands
 */
class erasePictureCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Erase Picture';
    }

    public function getLayer(): int
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return "#{$this->getLayer()}";
    }
}
