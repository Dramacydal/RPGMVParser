<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class commentCommand
 *
 * @package mh\entities\commands
 */
class commentCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Comment';
    }

    public function getComment(): string
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return $this->getComment();
    }
}
