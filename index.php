<?php

require_once 'vendor/autoload.php';

use function Validator\validate;
use App\Validator\Rules;

$data = [
    'name' => '',
    'age' => 'twenty',
    'birth_date' => 'invalid-date',
];

$rules = [
    'name' => [Rules::required()],
    'age' => [Rules::required(), Rules::numeric()],
    'birth_date' => [Rules::required(), Rules::date()],
];

$messages = [
    'name.required' => 'Имя обязательно для заполнения.',
    'age.required' => 'Возраст обязателен для заполнения.',
    'age.numeric' => 'Возраст должен быть числом.',
    'birth_date.required' => 'Дата рождения обязательна для заполнения.',
    'birth_date.date' => 'Дата рождения должна быть в формате даты.',
];

$validator = validate($data, $rules, $messages);

if ($validator->fails()) {
    echo "Validation failed:\n";
    print_r($validator->errors());
} else {
    echo "Validation passed!";
}