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

    public const package_type = [
        0 => 'Old',
        1 => 'New'
    ];

    public const position = [
        1 => 'JE',
        2 => 'SE',
        3 => 'SL',
        4 => 'L',
        5 => 'PM'
    ];

    public const member_type = [
        0 => 'Old',
        1 => 'New'
    ];
}
