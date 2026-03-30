<?php

namespace Validators;

use Framework\Validator\AbstractValidator;

class EmailValidator extends AbstractValidator
{

    protected string $message = 'Поле :field не правильный формат';

    public function rule(): bool
    {
        if ($this->value === null || $this->value === '') {
            return true;
        }

        $email = trim((string)$this->value);

        return preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email) === 1;
    }
}