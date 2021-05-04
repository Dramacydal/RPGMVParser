<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class rotatePictureCommand
 *
 * @package mh\entities\commands
 */
class rotatePictureCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Rotate Picture';
    }

    public function getLayer(): int
    {
        return $this->getParameter(0);
    }

    public function getSpeed(): int
    {
        return $this->getParameter(1);
    }

    public function getParametersDescription(): string
    {
        return "#{$this->getLayer()}, {$this->getSpeed()}";
    }
}
