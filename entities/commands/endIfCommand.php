<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;
use rp\parser;

/**
 * Class endIfCommand
 *
 * @package mh\entities\commands
 */
class endIfCommand extends abstractCommand
{
    public function __construct(array $data, parser $p)
    {
        parent::__construct($data, $p);
        $this->isSecondary = true;
    }

    function getName(): string
    {
        return 'End';
    }
}
