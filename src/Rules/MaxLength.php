<?php

namespace AwesomePhpCode\IteratorPattern\Rules;

use AwesomePhpCode\IteratorPattern\Constants\RuleType;
use AwesomePhpCode\IteratorPattern\Rule;

class MaxLength extends Rule
{
    public function __construct(string $name, int $position, $value)
    {
        parent::__construct(
            $name,
            RuleType::STRING,
            $position,
            function ($test) use ($value) {
                return mb_strlen($test) > $value;
            }
        );
    }
}
