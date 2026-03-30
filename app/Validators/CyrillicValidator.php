<?php

namespace Validators;

use Framework\Validator\AbstractValidator;

class CyrillicValidator extends AbstractValidator
{
    protected string $message = 'Поле :field не правильный формат';
    public function rule(): bool
    {
        if ($this->value === null || $this->value === '') {
            return true;
        }

        $name = trim((string)$this->value);

        return preg_match('/^[А-Яа-яЁё\s-]+$/', $name) === 1;
    }
}