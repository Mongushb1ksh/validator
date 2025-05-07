<?php

use App\Validator\Validator;

function validate(array $data, array $rules, array $messages = []): Validator
{
    return new Validator($data, $rules, $messages);
}