<?php

declare(strict_types=1);

namespace App\Services;

class Validator
{
    protected $errors = [];
    protected $messages = [
        'required' => 'Це поле є обов\'язковим',
        'email' => 'Невірний формат електронної пошти',
        'min' => 'Мінімальна довжина - :length символів',
        'max' => 'Максимальна довжина - :length символів',
        'strongRegex' => 'Допустимі лише літери та цифри без спеціальних символів',
        'lightRegex' => 'Допустимі лише літери, цифри та деякі спеціальні символи (,."\'":;)',
        'same' => 'Поле повинно співпадати з :otherField',
    ];
    protected $fieldNames = [
        'password' => 'Пароль',
        'confirm' => 'Підтвердження пароля',
        'login' => 'Логін',
        'user_name' => 'Ім\'я користувача',
        'middle_name' => 'По батькові',
        'last_name' => 'Прізвище',
        'email' => 'Електронна пошта',
    ];

    public function validate(array $data, array $rules) 
    {
        foreach ($rules as $field => $rulesArray) {
            foreach ($rulesArray as $rule) {
                $this->applyRule($field, $data, $rule);
            }
        }

        return empty($this->errors);
    }

    protected function applyRule($field, $data, $rule) :void
    {
        $value = $data[$field] ?? null;

        if ($rule == 'required' && empty($value)) {
            $this->addError($field, 'required');
        }

        if ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, 'email');
        }

        if (strpos($rule, 'min:') === 0) {
            $length = (int) str_replace('min:', '', $rule);
            if (strlen($value) < $length) {
                $this->addError($field, 'min', ['length' => $length]);
            }
        }

        if (strpos($rule, 'max:') === 0) {
            $length = (int) str_replace('max:', '', $rule);
            if (strlen($value) > $length) {
                $this->addError($field, 'max', ['length' => $length]);
            }
        }

        if ($rule == 'strongRegex' && !preg_match('/^[a-zA-Zа-яА-ЯіІїЇєЄґҐ0-9]*$/', $value)) {
            $this->addError($field, 'strongRegex');
        }

        if ($rule == 'lightRegex' && !preg_match('/^[a-zA-Zа-яА-ЯіІїЇєЄґҐ0-9,."\'":;]*$/', $value)) {
            $this->addError($field, 'lightRegex');
        }

        if (strpos($rule, 'same:') === 0) {
            $otherField = str_replace('same:', '', $rule);
            if ($value !== ($data[$otherField] ?? null)) {
                $this->addError($field, 'same', ['otherField' => $this->fieldNames[$otherField] ?? $otherField]);
            }
        }
    }

    protected function addError($field, $rule, $params = []) :void
    {
        $message = $this->resolveMessage($rule, $params);
        $this->errors[$field][] = str_replace(':attribute', $this->fieldNames[$field] ?? $field, $message);
    }

    protected function resolveMessage($rule, $params) :string
    {
        $message = $this->messages[$rule] ?? 'Validation error';
        foreach ($params as $key => $value) {
            $message = str_replace(":$key", $value, $message);
        }
        return $message;
    }

    public function getFirstError() :string
    {
        foreach ($this->errors as $field => $messages) {
            if (!empty($messages)) {
                return $messages[0]; 
            }
        }
        return null; 
    }
}
