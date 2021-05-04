<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class showChoicesCommand
 *
 * @package mh\entities\commands
 */
class showChoicesCommand extends abstractCommand
{
    const BACKGROUND_WINDOW      = 0;
    const BACKGROUND_DIM         = 1;
    const BACKGROUND_TRANSPARENT = 2;

    const POSITION_LEFT   = 0;
    const POSITION_RIGHT  = 2;
    const POSITION_MIDDLE = 1;

    const DEFAULT_CHOICE_NONE = -1;

    const CANCEL_CHOICE_BRANCH = -2;
    const CANCEL_CHOICE_DISALLOW = -1;

    public function getName(): string
    {
        return 'Show Choices';
    }

    /**
     * @return string[]
     */
    public function getChoices(): array
    {
        return $this->getParameter(0);
    }

    public function getCancelChoice(): int
    {
        return $this->getParameter(1);
    }

    public function getDefaultChoice(): int
    {
        return $this->getParameter(2);
    }

    public function getPosition(): int
    {
        return $this->getParameter(3);
    }

    public function getBackground(): int
    {
        return $this->getParameter(4);
    }

    public function getParametersDescription(): string
    {
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
            case self::POSITION_RIGHT:
                $position = 'Right';
                break;
            case self::POSITION_MIDDLE:
                $position = 'Middle';
                break;
            case self::POSITION_LEFT:
                $position = 'Left';
                break;
            default:
                throw new \Exception("Unknown position '{$this->getBackground()}'");
        }

        $defaultChoice = $this->getDefaultChoice();
        if ($defaultChoice == self::DEFAULT_CHOICE_NONE) {
            $defaultChoice = '-';
        } else {
            $defaultChoice = '#' . ($defaultChoice + 1);
        }

        $cancelChoice = $this->getCancelChoice();
        if ($cancelChoice == self::CANCEL_CHOICE_BRANCH || $cancelChoice == self::CANCEL_CHOICE_DISALLOW) {
            $cancelChoice = '-';
        } else {
            $cancelChoice = '#' . ($cancelChoice + 1);
        }

        return implode(', ', $this->getChoices()) . ", ($background, $position, $defaultChoice, $cancelChoice)";
    }
}
