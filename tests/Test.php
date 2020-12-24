<?php

namespace AwesomePhpCode\IteratorPattern\Tests;

use AwesomePhpCode\IteratorPattern\RuleCollection;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    /**
     * @test
     */
    public function itWorks()
    {
        $this->assertSame('foo', RuleCollection::foo());
    }
}