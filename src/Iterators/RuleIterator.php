<?php

namespace AwesomePhpCode\IteratorPattern\Iterators;

use AwesomePhpCode\IteratorPattern\Rule;

interface RuleIterator extends \Iterator
{
    public function current(): Rule;
}
