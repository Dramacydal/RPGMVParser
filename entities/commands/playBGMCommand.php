<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class playBGMCommand
 *
 * @package mh\entities\commands
 */
class playBGMCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Play BGM';
    }

    function getBGMData(): array
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        $bgmData = $this->getBGMData();

        if (empty($bgmData['name']))
            return 'None';

        return sprintf("%s (%s, %s, %s)", $bgmData['name'], $bgmData['volume'] ?? 0, $bgmData['pitch'] ?? 0, $bgmData['pan'] ?? 0);
    }
}
