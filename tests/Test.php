<?php

namespace AwesomePhpCode\IteratorPattern\Tests;

use AwesomePhpCode\IteratorPattern\RuleCollection;
use AwesomePhpCode\IteratorPattern\Rules\EvenInteger;
use AwesomePhpCode\IteratorPattern\Rules\MaxLength;
use AwesomePhpCode\IteratorPattern\Rules\IntegerGreaterThan;
use AwesomePhpCode\IteratorPattern\Rules\OddInteger;
use Exception;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    /**
     * @test
     * @dataProvider integerProvider
     * @param int $value
     * @param bool $greaterThan
     * @param bool $odd
     * @throws Exception
     */
    public function itIteratesEnabledAndIntegerTypeRulesByPosition(int $value, bool $greaterThan, bool $odd)
    {
        /**
         * Notice that IntegerTypeIterator only iterates enabled and integer type rules by position. Then,
         * $evenRule is not iterated because is disabled
         * $lengthRule is not iterated because is not integer type
         * Other rules (EvenInteger, IntegerGreaterThan) are iterated according to position
         * (i.e. first NumberGreaterThan and then OddInteger)
         */
        $evenRule = new EvenInteger('is even', 2);
        $evenRule->disable();
        $oddRule = new OddInteger('is odd', 4);
        $length = new MaxLength('string length greater than 100 characters', 3, 100);
        $greaterThanRule = new IntegerGreaterThan('greater than 50', 1, 50);

        $collection = new RuleCollection();
        $collection->addRuleStack([$evenRule, $oddRule, $length, $greaterThanRule]);

        $iterator = $collection->getIterator();

        $results = [];

        while ($iterator->valid()) {
            $rule = $iterator->current();
            $results[] = $rule->run($value);
            $iterator->next();
        }

        $this->assertSame(2, count($results));      // iterator only check two rules
        $this->assertSame($greaterThan, $results[0]);       // IntegerGreaterThan is iterated first
        $this->assertSame($odd, $results[1]);               // OddInteger is iterated then
    }

    public function integerProvider(): array
    {
        return [
            'Test 45 is not greater than 50 and is odd' => [45, false, true],
            'Test 48 is not greater than 50 and is not odd' => [48, false, false],
            'Test 51 is greater than 50 and is odd' => [51, true, true],
            'Test 58 is greater than 50 and is even' => [58, true, false],
        ];
    }
}
