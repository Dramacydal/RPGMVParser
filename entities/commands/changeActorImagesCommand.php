<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class changeActorImagesCommand
 *
 * @package mh\entities\commands
 */
class changeActorImagesCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Change Actor Images';
    }

    public function getActor(): int
    {
        return $this->getParameter(0);
    }

    public function getFaceImage(): string
    {
        return $this->getParameter(1);
    }

    public function getFaceImageOffset(): int
    {
        return $this->getParameter(2);
    }

    public function getCharacterImage(): string
    {
        return $this->getParameter(3);
    }

    public function getCharacterImageOffset(): int
    {
        return $this->getParameter(4);
    }

    public function getSwBattler(): string
    {
        return $this->getParameter(5);
    }

    public function getParametersDescription(): string
    {
        $str = "Actor #{$this->getActor()}";

        if ($this->getFaceImage())
            $str .= ", {$this->getFaceImage()}({$this->getFaceImageOffset()})";
        else
            $str .= ', None';

        if ($this->getCharacterImage())
            $str .= ", {$this->getCharacterImage()}({$this->getCharacterImageOffset()})";
        else
            $str .= ', None';

        if ($this->getSwBattler())
            $str .= ", {$this->getSwBattler()}";
        else
            $str .= ', None';

        return $str;
    }
}
