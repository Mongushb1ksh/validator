<?php

namespace App\Validator;

class Validator
{
    private array $data;
    private array $rules;
    private array $messages = [];
    private array $errors = [];

    public function __construct(array $data, array $rules, array $customMessages = [])
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->messages = $customMessages;
    }

    public function fails(): bool
    {
        foreach ($this->rules as $field => $ruleSet) {
            foreach ($ruleSet as $rule) {
                if (!$this->validateRule($field, $rule)) {
                    $this->addError($field, $rule);
                }
            }
        }
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    private function validateRule(string $field, string $rule): bool
    {
        $value = $this->data[$field] ?? null;

        switch ($rule) {
            case 'required':
                return !empty($value);
            case 'numeric':
                return is_numeric($value);
            case 'date':
                return strtotime($value) !== false;
            default:
                return true;
        }
    }

    private function addError(string $field, string $rule): void
    {
        $message = $this->messages["$field.$rule"] ?? "$field failed $rule validation";
        $this->errors[$field][] = $message;
    }
}