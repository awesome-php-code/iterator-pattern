<?php

namespace AwesomePhpCode\IteratorPattern\Rules;

use AwesomePhpCode\IteratorPattern\Constants\RuleType;
use AwesomePhpCode\IteratorPattern\Rule;

class IntegerGreaterThan extends Rule
{
    public function __construct(string $name, int $position, int $value)
    {
        parent::__construct(
            $name,
            RuleType::INTEGER,
            $position,
            function ($test) use ($value) {
                return $test > $value;
            }
        );
    }
}
