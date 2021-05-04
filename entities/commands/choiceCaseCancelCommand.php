<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;
use rp\parser;

/**
 * Class choiceCaseCancelCommand
 *
 * @package mh\entities\commands
 */
class choiceCaseCancelCommand extends abstractCommand
{
    public function __construct(array $data, parser $p)
    {
        parent::__construct($data, $p);
        $this->isSecondary = true;
    }

    public function getName(): string
    {
        return 'When';
    }

    public function getUnk0(): int
    {
        return $this->getParameter(0);
    }

    public function getUnk1()
    {
        return $this->getParameter(1);
    }

    public function getParametersDescription(): string
    {
        return 'Cancel';
    }
}
