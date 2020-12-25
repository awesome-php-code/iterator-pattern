<?php

namespace AwesomePhpCode\IteratorPattern\Iterators;

use AwesomePhpCode\IteratorPattern\Constants\RuleType;
use AwesomePhpCode\IteratorPattern\Rule;

class IntegerTypeIterator implements \Iterator
{
    /**
     * @var Rule[]
     */
    private array $collection;

    private int $key = 0;

    public function __construct(array $collection)
    {
        $this->filterEnabled($collection);
        $this->filterForIntegerRules($collection);
        $this->orderByPosition($collection);
        $this->collection = $collection;
    }

    public function current(): Rule
    {
        return $this->collection[$this->key];
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
        return isset($this->collection[$this->key]);
    }

    public function rewind(): void
    {
        $this->key = 0;
    }

    private function filterEnabled(array &$collection)
    {
        $collection = array_filter($collection, function ($value) {
            /** @var Rule $value */
            return $value->isEnabled();
        });
    }

    private function filterForIntegerRules(array &$collection)
    {
        $collection = array_filter($collection, function ($value) {
            /** @var Rule $value */
            return $value->getType() === RuleType::INTEGER;
        });
    }

    private function orderByPosition(array &$collection)
    {
        $positions = $this->getPositions($collection);
        asort($positions);

        $_collection = [];

        foreach ($positions as $key => $position) {
            /** @var Rule $rule */
            $_collection[] = $collection[$key];
        }

        $collection = $_collection;
    }

    private function getPositions($collection): array
    {
        $positions = [];
        foreach ($collection as $key => $rule) {
            /** @var Rule $rule */
            $positions[$key] = $rule->getPosition();
        }

        return $positions;
    }
}
