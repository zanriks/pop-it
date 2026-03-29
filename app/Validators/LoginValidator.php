<?php

namespace Validators;

use Framework\Validator\AbstractValidator;

class LoginValidator extends AbstractValidator
{
    protected string $message = 'Поле :field не правильное';
    public function rule(): bool
    {
        if ($this->value === null || $this->value === '') {
            return true;
        }

        $login = trim((string)$this->value);

        return preg_match('/^[a-zA-Z0-9]+$/', $login) === 1;
    }
}