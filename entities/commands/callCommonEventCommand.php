<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class callCommonEventCommand
 *
 * @package mh\entities\commands
 */
class callCommonEventCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Common Event';
    }

    public function getEventId(): int
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        $cCommonEvent = $this->getP()->getCommonEvent($this->getEventId());

        return "#{$this->getEventId()}" . ($cCommonEvent ? ' ' . $cCommonEvent->getName() : '');
    }
}
