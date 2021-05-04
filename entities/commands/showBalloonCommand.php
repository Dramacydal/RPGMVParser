<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class showBalloonCommand
 *
 * @package mh\entities\commands
 */
class showBalloonCommand extends abstractCommand
{
    const SOURCE_PLAYER = -1;
    const SOURCE_THIS_EVENT = 0;

    const ICON_EXCLAMATION = 1;
    const ICON_QUESTION = 2;
    const ICON_MUSIC_NOTE = 3;
    const ICON_HEART = 4;
    const ICON_ANGER = 5;
    const ICON_SWEAT = 6;
    const ICON_COBWEB = 7;
    const ICON_SILENCE = 8;
    const ICON_LIGHT_BULB = 9;
    const ICON_ZZZ = 10;
    const ICON_USER_DEFINED_1 = 11;
    const ICON_USER_DEFINED_2 = 12;
    const ICON_USER_DEFINED_3 = 13;
    const ICON_USER_DEFINED_4 = 14;
    const ICON_USER_DEFINED_5 = 15;

    public function getName(): string
    {
        return 'Show Balloon Icon';
    }

    public function getSource(): int
    {
        return $this->getParameter(0);
    }

    public function getBalloonIcon(): int
    {
        return $this->getParameter(1);
    }

    public function getWaitForCompletion(): bool
    {
        return $this->getParameter(2);
    }

    public function getParametersDescription(): string
    {
        switch ($this->getSource()) {
            case self::SOURCE_PLAYER:
                $str = 'Player';
                break;
            case self::SOURCE_THIS_EVENT:
                $str = 'This Event';
                break;
            default:
                $str = "Event #{$this->getSource()}";
                break;
        }

        $str .= ', ';

        switch ($this->getBalloonIcon()) {
            case self::ICON_EXCLAMATION:
                $str .= 'Exclamation';
                break;
            case self::ICON_QUESTION:
                $str .= 'Question';
                break;
            case self::ICON_MUSIC_NOTE:
                $str .= 'Music Note';
                break;
            case self::ICON_HEART:
                $str .= 'Heart';
                break;
            case self::ICON_ANGER:
                $str .= 'Anger';
                break;
            case self::ICON_SWEAT:
                $str .= 'Sweat';
                break;
            case self::ICON_COBWEB:
                $str .= 'Cobweb';
                break;
            case self::ICON_SILENCE:
                $str .= 'Silence';
                break;
            case self::ICON_LIGHT_BULB:
                $str .= 'Light Bulb';
                break;
            case self::ICON_ZZZ:
                $str .= 'Zzz';
                break;
            case self::ICON_USER_DEFINED_1:
                $str .= 'User-defined 1';
                break;
            case self::ICON_USER_DEFINED_2:
                $str .= 'User-defined 2';
                break;
            case self::ICON_USER_DEFINED_3:
                $str .= 'User-defined 3';
                break;
            case self::ICON_USER_DEFINED_4:
                $str .= 'User-defined 4';
                break;
            case self::ICON_USER_DEFINED_5:
                $str .= 'User-defined 5';
                break;
            default:
                throw new \Exception("Unknown baloon icon '{$this->getBalloonIcon()}'");
        }

        if ($this->getWaitForCompletion()) {
            $str .= ' (Wait)';
        }

        return $str;
    }
}
