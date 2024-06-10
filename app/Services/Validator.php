<?php

namespace App\Services;

class Validator
{
    protected $errors = [];

    public function validate(array $data, array $rules)
    {
        foreach($rules as $field => $rulesArray)
        {
            foreach($rulesArray as $rule)
            {
                $this->applyRule($field, $data, $rule);
            }
        }

        return empty($this->errors);
    }

    protected function applyRule($field, $data, $rule)
    {
        $value = isset($data[$field]) ? $data[$field] : null;

        if($rule == 'required' && empty($value))
        {
            $this->errors[$field][] = 'This field is required';
        }

        if ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = 'Invalid email format';
        }

        if (strpos($rule, 'min:') === 0) {
            $length = (int) str_replace('min:', '', $rule);
            if (strlen($value) < $length) {
                $this->errors[$field][] = "Minimum length is $length";
            }
        }

        if (strpos($rule, 'max:') === 0) {
            $length = (int) str_replace('max:', '', $rule);
            if (strlen($value) > $length) {
                $this->errors[$field][] = "Maximum length is $length";
            }
        }

        if ($rule == 'no_special_chars' && !preg_match('/^[a-zA-Z0-9\s,;"<>\[\]\(\)\{\}]+$/', $value)) {
            $this->errors[$field][] = 'Special characters are not allowed';
        }

        if (strpos($rule, 'same:') === 0) {
            $otherField = str_replace('same:', '', $rule);
            if ($value !== ($data[$otherField] ?? null)) {
                $this->errors[$field][] = 'The field must match ' . $otherField;
            }
        }
        
    }

    public function getErrors()
    {
        return $this->errors;
    }

}