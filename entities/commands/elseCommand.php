<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;
use rp\parser;

/**
 * Class elseCommand
 *
 * @package mh\entities\commands
 */
class elseCommand extends abstractCommand
{
    public function __construct(array $data, parser $p)
    {
        parent::__construct($data, $p);
        $this->isSecondary = true;
    }

    function getName(): string
    {
        return 'Else';
    }
}
