<?php

namespace AwesomePhpCode\IteratorPattern\Contracts;

use AwesomePhpCode\IteratorPattern\Iterators\IntegerTypeIterator;

interface RuleCollectionInterface extends \IteratorAggregate
{
    public function getIterator(): IntegerTypeIterator;
}