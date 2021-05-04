<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;
use rp\entities\commands\movement\moveAtRandomCommand;
use rp\entities\commands\movement\moveAwayFromPlayerCommand;
use rp\entities\commands\movement\moveBlendModeCommand;
use rp\entities\commands\movement\moveDirectionFixOffCommand;
use rp\entities\commands\movement\moveDirectionFixOnCommand;
use rp\entities\commands\movement\moveDownCommand;
use rp\entities\commands\movement\moveEmptyCommand;
use rp\entities\commands\movement\moveFrequencyCommand;
use rp\entities\commands\movement\moveImageCommand;
use rp\entities\commands\movement\moveJumpCommand;
use rp\entities\commands\movement\moveLeftCommand;
use rp\entities\commands\movement\moveLowerLeftCommand;
use rp\entities\commands\movement\moveLowerRightCommand;
use rp\entities\commands\movement\moveOneStepBackwardCommand;
use rp\entities\commands\movement\moveOneStepForwardCommand;
use rp\entities\commands\movement\moveOpacityCommand;
use rp\entities\commands\movement\moveRightCommand;
use rp\entities\commands\movement\moveScriptCommand;
use rp\entities\commands\movement\moveSECommand;
use rp\entities\commands\movement\moveSpeedCommand;
use rp\entities\commands\movement\moveSteppingAnimationOffCommand;
use rp\entities\commands\movement\moveSteppingAnimationOnCommand;
use rp\entities\commands\movement\moveSwitchOffCommand;
use rp\entities\commands\movement\moveSwitchOnCommand;
use rp\entities\commands\movement\moveThroughOffCommand;
use rp\entities\commands\movement\moveThroughOnCommand;
use rp\entities\commands\movement\moveTowardPlayerCommand;
use rp\entities\commands\movement\moveTransparentOffCommand;
use rp\entities\commands\movement\moveTransparentOnCommand;
use rp\entities\commands\movement\moveTurn180DegreesCommand;
use rp\entities\commands\movement\moveTurn90DegreesLeftCommand;
use rp\entities\commands\movement\moveTurn90DegreesRightCommand;
use rp\entities\commands\movement\moveTurn90DegreesRightOrLeftCommand;
use rp\entities\commands\movement\moveTurnAtRandomCommand;
use rp\entities\commands\movement\moveTurnAwayFromPlayerCommand;
use rp\entities\commands\movement\moveTurnDownCommand;
use rp\entities\commands\movement\moveTurnLeftCommand;
use rp\entities\commands\movement\moveTurnRightCommand;
use rp\entities\commands\movement\moveTurnTowardPlayerCommand;
use rp\entities\commands\movement\moveTurnUpCommand;
use rp\entities\commands\movement\moveUpCommand;
use rp\entities\commands\movement\moveUpperLeftCommand;
use rp\entities\commands\movement\moveUpperRightCommand;
use rp\entities\commands\movement\moveWaitCommand;
use rp\entities\commands\movement\moveWalkingAnimationOffCommand;
use rp\entities\commands\movement\moveWalkingAnimationOnCommand;
use rp\movementCommandCodes;
use rp\parser;

/**
 * Class movementRouteCommand
 *
 * @package mh\entities\commands
 */
class movementRouteCommand extends abstractCommand
{
    public function __construct(array $data, parser $p)
    {
        parent::__construct($data, $p);
        $this->isSecondary = true;
    }

    function getName(): string
    {
        return '                  ';
    }

    public static function movementCommandFactory(array $commandData, parser $w): abstractCommand
    {
        $code = $commandData['code'] ?? '';
        switch ($code) {
            case movementCommandCodes::CODE_EMPTY:
                return new moveEmptyCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_DOWN:
                return new moveDownCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_LEFT:
                return new moveLeftCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_RIGHT:
                return new moveRightCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_UP:
                return new moveUpCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_LOWER_LEFT:
                return new moveLowerLeftCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_LOWER_RIGHT:
                return new moveLowerRightCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_UPPER_LEFT:
                return new moveUpperLeftCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_UPPER_RIGHT:
                return new moveUpperRightCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_AT_RANDOM:
                return new moveAtRandomCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TOWARD_PLAYER:
                return new moveTowardPlayerCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_AWAY_FROM_PLAYER:
                return new moveAwayFromPlayerCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_ONE_STEP_FORWARD:
                return new moveOneStepForwardCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_ONE_STEP_BACKWARD:
                return new moveOneStepBackwardCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_JUMP:
                return new moveJumpCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_WAIT:
                return new moveWaitCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TURN_DOWN:
                return new moveTurnDownCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TURN_LEFT:
                return new moveTurnLeftCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TURN_RIGHT:
                return new moveTurnRightCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TURN_UP:
                return new moveTurnUpCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TURN_90_DEGREES_RIGHT:
                return new moveTurn90DegreesRightCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TURN_90_DEGREES_LEFT:
                return new moveTurn90DegreesLeftCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TURN_180_DEGREES:
                return new moveTurn180DegreesCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TURN_90_DEGREES_RIGHT_OR_LEFT:
                return new moveTurn90DegreesRightOrLeftCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TURN_AT_RANDOM:
                return new moveTurnAtRandomCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TURN_TOWARD_PLAYER:
                return new moveTurnTowardPlayerCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TURN_AWAY_FROM_PLAYER:
                return new moveTurnAwayFromPlayerCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_SWITCH_ON:
                return new moveSwitchOnCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_SWITCH_OFF:
                return new moveSwitchOffCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_SPEED:
                return new moveSpeedCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_FREQUENCY:
                return new moveFrequencyCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_WALKING_ANIMATION_ON:
                return new moveWalkingAnimationOnCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_WALKING_ANIMATION_OFF:
                return new moveWalkingAnimationOffCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_STEPPING_ANIMATION_ON:
                return new moveSteppingAnimationOnCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_STEPPING_ANIMATION_OFF:
                return new moveSteppingAnimationOffCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_DIRECTION_FIX_ON:
                return new moveDirectionFixOnCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_DIRECTION_FIX_OFF:
                return new moveDirectionFixOffCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_THROUGH_ON:
                return new moveThroughOnCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_THROUGH_OFF:
                return new moveThroughOffCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TRANSPARENT_ON:
                return new moveTransparentOnCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_TRANSPARENT_OFF:
                return new moveTransparentOffCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_IMAGE:
                return new moveImageCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_OPACITY:
                return new moveOpacityCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_BLEND_MODE:
                return new moveBlendModeCommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_SE:
                return new moveSECommand($commandData, $w);
            case movementCommandCodes::CODE_MOVE_SCRIPT:
                return new moveScriptCommand($commandData, $w);
            default:
                throw new \Exception("Unknown movement command code '{$code}'");
        }
    }

    public function getCommandData(): array
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        $moveCommand = static::movementCommandFactory($this->getCommandData(), $this->getP());

        return $moveCommand->asString();
    }
}
