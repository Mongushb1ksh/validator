<?php

namespace App\Validator;

class Rules
{
    public static function required(): string
    {
        return 'required';
    }

    public static function numeric(): string
    {
        return 'numeric';
    }

    public static function date(): string
    {
        return 'date';
    }
}