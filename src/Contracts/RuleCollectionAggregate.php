<?php

namespace AwesomePhpCode\IteratorPattern\Contracts;

use AwesomePhpCode\IteratorPattern\Iterators\IntegerTypeIterator;

interface RuleCollectionAggregate extends \IteratorAggregate
{
    public function getIterator(): IntegerTypeIterator;
}
