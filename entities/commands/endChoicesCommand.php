<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;
use rp\parser;

/**
 * Class endChoicesCommand
 *
 * @package mh\entities\commands
 */
class endChoicesCommand extends abstractCommand
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
