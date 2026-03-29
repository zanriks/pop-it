<?php

namespace Validators;

use Framework\Validator\AbstractValidator;

class PasswordValidator extends AbstractValidator
{
    protected string $message = 'Поле :field не правильное';
    public function rule(): bool
    {
        if ($this->value === null || $this->value === '') {
            return true;
        }

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/';
        return preg_match($pattern, $this->value);
    }
}