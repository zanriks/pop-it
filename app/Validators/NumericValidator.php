<?php

namespace Validators;

use Framework\Validator\AbstractValidator;

class NumericValidator extends AbstractValidator
{
    public function rule(): bool
    {
        $pattern = '/\d+/';
        return preg_match($pattern, $this->value);
    }
}