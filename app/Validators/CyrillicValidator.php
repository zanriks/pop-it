<?php

namespace Validators;

use Framework\Validator\AbstractValidator;

class CyrillicValidator extends AbstractValidator
{
    public function rule(): bool
    {
        $pattern = '/^[а-яё\s-]+$/ui';
        return preg_match($pattern, $this->value);
    }
}