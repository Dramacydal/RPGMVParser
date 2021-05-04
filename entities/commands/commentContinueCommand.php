<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;
use rp\parser;

/**
 * Class commentContinueCommand
 *
 * @package mh\entities\commands
 */
class commentContinueCommand extends abstractCommand
{
    public function __construct(array $data, parser $p)
    {
        parent::__construct($data, $p);
        $this->isSecondary = true;
    }

    function getName(): string
    {
        return '       ';
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
