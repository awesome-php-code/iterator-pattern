<?php

namespace AwesomePhpCode\IteratorPattern;

use AwesomePhpCode\IteratorPattern\Iterators\IntegerTypeIterator;

class RuleCollection implements \IteratorAggregate
{
    /**
     * @var Rule[]
     */
    private array $rules;

    public function addRule(Rule $rule): void
    {
        $this->rules[] = $rule;
    }

    /**
     * @param Rule[]
     */
    public function addRuleStack(array $rules)
    {
        array_map('self::addRule', $rules);
    }

    public function getIterator(): IntegerTypeIterator
    {
        return new IntegerTypeIterator($this->rules);
    }
}
