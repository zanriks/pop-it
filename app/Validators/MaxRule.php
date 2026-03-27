<?php

namespace Validators;

use Src\Validator\AbstractValidator;
class MaxRule extends AbstractValidator
{
    public function rule(): bool
    {
        $max = (int) $this->args[0];
        return mb_strlen($this->value) <= $max;
    }
    public function validate(): string
    {
        return str_replace(':max', $this->args[0], $this->message);
    }
}