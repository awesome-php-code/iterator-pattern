<?php

namespace AwesomePhpCode\IteratorPattern\Iterators;

use AwesomePhpCode\IteratorPattern\Constants\RuleType;
use AwesomePhpCode\IteratorPattern\Contracts\RuleIterator;
use AwesomePhpCode\IteratorPattern\Rule;
use AwesomePhpCode\IteratorPattern\RuleCollection;

class IntegerTypeIterator implements RuleIterator
{
    private RuleCollection $collection;

    private array $rules = [];

    private int $key = 0;

    public function __construct(RuleCollection $collection)
    {
        $this->collection = $collection;
        $rules = $collection->getRules();
        $this->filterEnabled($rules);
        $this->filterForIntegerRules($rules);
        $this->orderByPosition($rules);
        $this->rules = $rules;
    }

    public function current(): Rule
    {
        return $this->rules[$this->key];
    }

    public function next(): void
    {
        ++$this->key;
    }

    public function key()
    {
        return $this->key;
    }

    public function valid(): bool
    {
        return isset($this->rules[$this->key]);
    }

    public function rewind(): void
    {
        $this->key = 0;
    }

    private function filterEnabled(array &$rules)
    {
        $rules = array_filter($rules, function ($value) {
            /** @var Rule $value */
            return $value->isEnabled();
        });
    }

    private function filterForIntegerRules(array &$rules)
    {
        $rules = array_filter($rules, function ($value) {
            /** @var Rule $value */
            return $value->getType() === RuleType::INTEGER;
        });
    }

    private function orderByPosition(array &$rules)
    {
        $positions = $this->getPositions($rules);
        asort($positions);

        $_rules = [];

        foreach ($positions as $key => $position) {
            /** @var Rule $rule */
            $_rules[] = $rules[$key];
        }

        $rules = $_rules;
    }

    private function getPositions($rules): array
    {
        $positions = [];
        foreach ($rules as $key => $rule) {
            /** @var Rule $rule */
            $positions[$key] = $rule->getPosition();
        }

        return $positions;
    }
}
