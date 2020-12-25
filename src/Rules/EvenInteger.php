<?php

namespace AwesomePhpCode\IteratorPattern\Rules;

use AwesomePhpCode\IteratorPattern\Constants\RuleType;
use AwesomePhpCode\IteratorPattern\Rule;

class EvenInteger extends Rule
{
    public function __construct(string $name, int $position)
    {
        parent::__construct($name, RuleType::INTEGER, $position, function($value) { return $value % 2 === 0; });
    }
}