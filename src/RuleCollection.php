<?php

namespace AwesomePhpCode\IteratorPattern;

use AwesomePhpCode\IteratorPattern\Contracts\RuleCollectionAggregate;
use AwesomePhpCode\IteratorPattern\Iterators\IntegerTypeIterator;

class RuleCollection implements RuleCollectionAggregate
{
    /**
     * @var Rule[]
     */
    private array $rules;

    public function getRules(): array
    {
        return $this->rules;
    }

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
        return new IntegerTypeIterator($this);
    }
}
