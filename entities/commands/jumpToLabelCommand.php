<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class jumpToLabelCommand
 *
 * @package mh\entities\commands
 */
class jumpToLabelCommand extends abstractCommand
{
    public function getName(): string
    {
        return 'Jump to label';
    }

    public function getLabel(): string
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return $this->getLabel();
    }
}
