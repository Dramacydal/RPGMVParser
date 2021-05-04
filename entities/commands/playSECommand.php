<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class playSECommand
 *
 * @package mh\entities\commands
 */
class playSECommand extends abstractCommand
{
    function getName(): string
    {
        return 'Play SE';
    }

    function getSEData(): array
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        $seData = $this->getSEData();
        if (empty($seData['name']))
            return 'None';

        return sprintf("%s (%s, %s, %s)", $seData['name'], $seData['volume'] ?? 0, $seData['pitch'] ?? 0, $seData['pan'] ?? 0);
    }
}
