<?php

namespace Validators;

use Framework\Validator\AbstractValidator;

class EmailValidator extends AbstractValidator
{
    protected string $message = "Поле :field должно быть корректным email-адресом. Введено: :value";

    public function rule(): bool
    {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($pattern, $this->value);
    }
}