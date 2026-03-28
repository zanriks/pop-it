<?php

namespace Validators;

use Framework\Validator\AbstractValidator;

class MinRule extends AbstractValidator
{
    public function rule(): bool
    {
        $min = (int) $this->args[0];
        return mb_strlen($this->value) >= $min;
    }
    public function validate(): string
    {
        return str_replace(':min', $this->args[0], $this->message);
    }
}