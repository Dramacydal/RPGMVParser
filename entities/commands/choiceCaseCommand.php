<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;
use rp\parser;

/**
 * Class choiceCaseCommand
 *
 * @package mh\entities\commands
 */
class choiceCaseCommand extends abstractCommand
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

    public function getChoiceIndex(): int
    {
        return $this->getParameter(0);
    }

    public function getChoiceName(): string
    {
        return $this->getParameter(1);
    }

    public function getParametersDescription(): string
    {
        return "{$this->getChoiceName()}";
    }
}
