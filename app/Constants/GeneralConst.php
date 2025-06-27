<?php

namespace App\Constants;

class GeneralConst
{
    public const APP_NAME = 'Medical Check-Up System';
    // Roles
    public const ADMIN = 1;
    public const USER = 2;
    public const ROLES = [
        self::ADMIN => 'Admin',
        self::USER => 'User',
    ];

    public const OLD = 0;
    public const NEW = 1;
    public const PACKAGE_TYPES = [
        self::OLD => 'Old',
        self::NEW => 'New'
    ];

    public const MEMBER_TYPES = [
        self::OLD => 'Old',
        self::NEW => 'New'
    ];

    public const JE = 1 ;
    public const SE = 2 ;
    public const SL = 3 ;
    public const L = 4 ;
    public const PM = 5 ;
    public const POSITION = [
        self::JE    => 'JE',
        self::SE    => 'SE',
        self::SL    => 'SL',
        self::L     => 'L',
        self::PM    => 'PM'
    ];

    public const INFORM = 1;
    public const CONFIRM = 2;
    public const CANCEL = 3;
    public const STATUS = [
        self::INFORM    => 'Inform',
        self::CONFIRM   => 'Confirm',
        self::CANCEL    => 'Cancel'
    ];

    public const TURE = 1;
    public const FALSE = 0;

    public const CHECKUP = 1 ;
    public const UNCHECK = 0 ;
    public const CHECK_FLG = [
        self::CHECKUP => 'Check-up',
        self::UNCHECK => 'Uncheck'
    ];
    
}
