<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;
use rp\parser;

/**
 * Class showTextLineCommand
 *
 * @package mh\entities\commands
 */
class showTextLineCommand extends abstractCommand
{
    public function __construct(array $data, parser $p)
    {
        parent::__construct($data, $p);
        $this->isSecondary = true;
    }

    public function getName(): string
    {
        return '    ';
    }

    public function getText(): string
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return $this->getText();
    }
}
