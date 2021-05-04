<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class setMovementRouteCommand
 *
 * @package mh\entities\commands
 */
class setMovementRouteCommand extends abstractCommand
{
    const SOURCE_PLAYER = -1;
    const SOURCE_THIS_EVENT = 0;

    public function getName(): string
    {
        return 'Set Movement Route';
    }

    public function getSource(): int
    {
        return $this->getParameter(0);
    }

    public function getRoute(): array
    {
        return $this->getParameter(1);
    }

    public function getParametersDescription(): string
    {
        $route = $this->getRoute();

        switch ($this->getSource()) {
            case self::SOURCE_PLAYER:
                $str = "Player";
                break;
            case self::SOURCE_THIS_EVENT:
                $str = "This Event";
                break;
            default:
                $str = "Event #{$this->getSource()}";
                break;
        }

        $parts = [];
        if ($route['repeat']) {
            $parts[] = 'Repeat';
        }
        if ($route['skippable']) {
            $parts[] = 'Skip';
        }
        if ($route['wait']) {
            $parts[] = 'Wait';
        }

        if (!empty($parts)) {
            $str .= ' (' . implode(', ', $parts) . ')';
        }

        return $str;
    }
}
