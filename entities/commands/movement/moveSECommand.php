<?php

namespace rp\entities\commands\movement;

/**
 * Class moveSECommand
 *
 * @package mh\entities\commands\movement
 */
class moveSECommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'SE';
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
