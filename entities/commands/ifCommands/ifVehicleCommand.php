<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifVehicleCommand
 *
 *      [1] - vehicle id
 *
 * @package mh\entities\commands\ifCommands
 */
class ifVehicleCommand extends ifCommand
{
    public function getVehicle(): string
    {
        return $this->getParameter(1);
    }

    public function getParametersDescription(): string
    {
        return "#'{$this->getVehicle()}' is driven";
    }
}
