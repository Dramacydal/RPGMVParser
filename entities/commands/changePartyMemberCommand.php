<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class changePartyMemberCommand
 *
 * @package mh\entities\commands
 */
class changePartyMemberCommand extends abstractCommand
{
    const ACTOR_ADD = 0;
    const ACTOR_REMOVE = 1;

    public function getName(): string
    {
        return "Change Party Member";
    }

    public function getActor(): int
    {
        return $this->getParameter(0);
    }

    public function getAddOrRemove(): int
    {
        return $this->getParameter(1);
    }

    public function getInitialize(): bool
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        switch ($this->getAddOrRemove()) {
            case self::ACTOR_ADD:
                $str = 'Add';
                break;
            case self::ACTOR_REMOVE:
                $str = 'Remove';
                break;
            default:
                throw new \Exception("Unknown add/remove state for party member");
        }

        $str .= " Actor #{$this->getActor()}";
        if ($this->getInitialize()) {
            $str .= ' (Initialize)';
        }

        return $str;
    }
}
