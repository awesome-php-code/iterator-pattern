<?php

namespace AwesomePhpCode\IteratorPattern\Contracts;

use AwesomePhpCode\IteratorPattern\Rule;

interface RuleIterator extends \Iterator
{
    public function current(): Rule;
}
