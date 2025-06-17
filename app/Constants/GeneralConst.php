<?php

namespace App\Constants;

class GeneralConst
{
    public const APP_NAME = 'Laravel Structure App';
    // Roles
    public const ADMIN = 1;
    public const USER = 2;
    public const ROLES = [
        self::ADMIN => 'Admin',
        self::USER => 'User',
    ];
}
