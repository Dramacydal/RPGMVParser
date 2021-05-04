<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class showTextBaseCommand
 *
 * @package mh\entities\commands
 */
class showTextBaseCommand extends abstractCommand
{
    const BACKGROUND_WINDOW      = 0;
    const BACKGROUND_DIM         = 1;
    const BACKGROUND_TRANSPARENT = 2;

    const POSITION_TOP = 0;
    const POSITION_MIDDLE = 1;
    const POSITION_BOTTOM = 2;

    public function getName(): string
    {
        return 'Text';
    }

    public function getFace(): string
    {
        return $this->getParameter(0);
    }

    public function getOffset(): int
    {
        return $this->getParameter(1);
    }

    public function getBackground(): int
    {
        return $this->getParameter(2);
    }

    public function getPosition(): int
    {
        return $this->getParameter(3);
    }

    public function getParametersDescription(): string
    {
        $face = $this->getFace();
        if (empty($face)) {
            $face = 'None';
        } else {
            $face = "{$face}({$this->getOffset()})";
        }

        switch ($this->getBackground()) {
            case self::BACKGROUND_WINDOW:
                $background = 'Window';
                break;
            case self::BACKGROUND_DIM:
                $background = 'Dim';
                break;
            case self::BACKGROUND_TRANSPARENT:
                $background = 'Transparent';
                break;
            default:
                throw new \Exception("Unknown background '{$this->getBackground()}'");
        }

        switch ($this->getPosition()) {
            case self::POSITION_TOP:
                $position = 'Top';
                break;
            case self::POSITION_MIDDLE:
                $position = 'Middle';
                break;
            case self::POSITION_BOTTOM:
                $position = 'Bottom';
                break;
            default:
                throw new \Exception("Unknown position '{$this->getBackground()}'");
        }

        return "$face, $background, $position";
    }
}
