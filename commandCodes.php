<?php

namespace rp;

class commandCodes
{
    const CODE_EMPTY                    = 0;
    const CODE_SHOW_TEXT_BASE           = 101; // 0 - image name
    const CODE_SHOW_CHOICES             = 102; // 0 - array of choices
    const CODE_INPUT_NUMBER             = 103;
    const CODE_SELECT_ITEM              = 104;
    const CODE_SHOW_SCROLLING_TEXT_BASE = 105; // 0 - speed
    const CODE_COMMENT                  = 108;
    const CODE_IF                       = 111;
    const CODE_EXIT_EVENT_PROCESSING    = 115;
    const CODE_CALL_COMMON_EVENT        = 117;
    const CODE_LABEL                    = 118;
    const CODE_JUMP_TO_LABEL            = 119;
    const CODE_CONTROL_SWITCHES         = 121;
    const CODE_CONTROL_VARIABLES        = 122;
    const CODE_CONTROL_SELF_SWITCH      = 123;
    const CODE_CHANGE_GOLD              = 125;
    const CODE_CHANGE_ITEMS             = 126;
    const CODE_CHANGE_WEAPONS           = 127;
    const CODE_CHANGE_ARMORS            = 128;
    const CODE_CHANGE_PARTY_MEMBER      = 129;
    const CODE_TRANSFER_PLAYER          = 201;
    const CODE_SET_VEHICLE_LOCATION     = 202;
    const CODE_SET_EVENT_LOCATION       = 203;
    const CODE_SCROLL_MAP               = 204;
    const CODE_SET_MOVEMENT_ROUTE       = 205;
    const CODE_CHANGE_TRANSPARENCY      = 211;
    const CODE_SHOW_ANIMATION           = 212;
    const CODE_SHOW_BALOON_ICON         = 213;
    const CODE_FADEOUT_SCREEN           = 221;
    const CODE_FADEIN_SCREEN            = 222;
    const CODE_TINT_SCREEN              = 223;
    const CODE_SHAKE_SCREEN             = 225;
    const CODE_WAIT                     = 230;
    const CODE_SHOW_PICTURE             = 231;
    const CODE_MOVE_PICTURE             = 232;
    const CODE_ROTATE_PICTURE           = 233;
    const CODE_TINT_PICTURE             = 234;
    const CODE_ERASE_PICTURE            = 235;
    const CODE_SET_WEATHER_EFFECT       = 236;
    const CODE_PLAY_BGM                 = 241;
    const CODE_FADEOUT_BGM              = 242;
    const CODE_SAVE_BGM                 = 243;
    const CODE_REPLAY_BGM               = 244;
    const CODE_PLAY_ME                  = 249;
    const CODE_PLAY_SE                  = 250;
    const CODE_GET_LOCATION_INFO        = 285;
    const CODE_BATTLE_PROCESSING        = 301;
    const CODE_CHANGE_HP                = 311;
    const CODE_CHANGE_MP                = 312;
    const CODE_CHANGE_STATE             = 313;
    const CODE_RECOVER_ALL              = 314;
    const CODE_CHANGE_EXP               = 315;
    const CODE_CHANGE_LEVEL             = 316;
    const CODE_CHANGE_PARAMETER         = 317;
    const CODE_CHANGE_SKILL             = 318;
    const CODE_CHANGE_ACTOR_IMAGES      = 322;
    const CODE_CHANGE_TP                = 326;
    const CODE_CHANGE_ENEMY_HP          = 331;
    const CODE_CHANGE_ENEMY_MP          = 332;
    const CODE_CHANGE_ENEMY_TP          = 342;
    const CODE_SCRIPT                   = 355;
    const CODE_PLUGIN_COMMAND           = 356;
    const CODE_SHOW_TEXT_LINE           = 401; // 0 - text, related to 101
    const CODE_CHOICE_CASE              = 402; // : when "asd":, 0 - choice index, 1 - choice text
    const CODE_CHOICE_CASE_CANCEL       = 403; // : when Cancel
    const CODE_CHOICES_END              = 404; // :end
    const CODE_SHOW_TEXT_ANIMATED_LINE  = 405; // 0 - text, related to 105
    const CODE_COMMENT_CONTINUE         = 408; // 0 - text, related to 108
    const CODE_ELSE                     = 411;
    const CODE_ENDIF                    = 412;
    const CODE_MOVEMENT_ROUTE_COMMAND   = 505;
    const CODE_BATTLE_PROCESSING_WIN    = 601; // "if win" case for event 301
    const CODE_BATTLE_PROCESSING_RUN    = 602; // "if run" case for event 301
    const CODE_BATTLE_PROCESSING_LOSE   = 603; // "if lose" case for event 301
    const CODE_BATTLE_PROCESSING_END    = 604; // close indent for event 301

    public static function isImageCode($code): bool
    {
        switch ($code) {
            case self::CODE_SHOW_PICTURE:
            case self::CODE_MOVE_PICTURE:
            case self::CODE_ROTATE_PICTURE:
            case self::CODE_TINT_PICTURE:
            case self::CODE_ERASE_PICTURE:
                return true;
            default:
                break;
        }

        return false;
    }
}
