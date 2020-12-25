# :pushpin: Rule Iterator Sample in PHP

This sample shows how the iterator pattern can be used to iterate some rules :pencil:.

# What is the Iterator Pattern :question:

Iterator is a behavioral design pattern that lets you traverse elements of a collection without exposing its underlying representation (list, stack, tree, etc.).

# When to use the Iterator Pattern :question:

:heavy_check_mark: Use this pattern when the logic of iteration is not usual. You could split responsibilities creating one or more classes for iterations.

:heavy_check_mark: Use this pattern to reduce duplicated code. When no iterator is defined the code of iteration is usually created in the client side generating duplications!.

:heavy_check_mark: Use the Iterator when you want your code to be able to traverse different data structures or when types of these structures are unknown beforehand.

# What you expect of iterators :question:

:white_check_mark: The primary responsibility for a collection is store objects!, not traverse it!.

:white_check_mark: All iterators must implement the same interface.

:white_check_mark: The pattern provides a couple of generic interfaces for both collections and iterators.

For more information about this pattern you can check [this page](https://refactoring.guru/design-patterns/iterator).
The following is the implementation of this pattern to solve a basic problem of iterating rules.

# :paperclip: The Problem

Imagine you need ensure that a set of rules are applied to a single value. So, in your code you have the following rules ready to be applied. 

1) The integer is odd
2) The integer is even
3) The string length is greater than 100 characters
4) The integer is greater than 50

As you may think, all this rules end up in a bool value to check if a given value meets the requirement. For integer values,
you only need a subset of these rules to be applied (1, 2, 4), and for strings you only need the third rule to be applied.
Also, each rule has a status (enabled/disabled) and a position. A rule must be applied it's enabled, if the given type match, 
and applied id ascending order for the position field.

# :bulb: The Solution

:large_blue_diamond: Step 1: We need to declare the **iterator interface**.
In PHP most of the problems can be solved through the built-in `\Iterator` interface.
This contract defines the following operations for iterators.

```php
interface Iterator extends Traversable {
    public function current();
    public function next();
    public function key();
    public function valid();
    public function rewind();
}
```

`current()`: Returns the current element

`next()`: Moves forward to next element.

`key()`: Returns the key of the current element.

`valid()`: Checks if current position is valid.

`rewind()`: Rewinds the Iterator to the first element.

Is a good practice to extend this interface to force current object type. In our case we need to return `Rule` type.

```php
interface RuleIterator extends \Iterator
{
    public function current(): Rule;
}
```

:large_blue_diamond: Step 2: We need to declare the **Iterable collection interface**.
Again, In PHP most of the problems can be solved through the built-in `\IteratorAggregate` interface.

```php
interface IteratorAggregate extends Traversable {
    public function getIterator();
}
```

`getIterator()`: Retrieves an external iterator.

Keep in mind the collection interface declares one or multiple methods for getting iterators compatible with the collection.
We only need for now one method to return the `IntegerTypeIterator` iterator. Is a good practice to extend this interface to force
the iterator type.

```php
interface RuleCollectionAggregate extends \IteratorAggregate
{
    public function getIterator(): IntegerTypeIterator;
}
```

:large_blue_diamond: Step 3: Of course, we need specific implementations for these interfaces. We need a `RuleCollection` to store our `Rule` objects and
a `IntegerTypeIterator` for iterate integer type rules. Take your time to review the following diagram.

<p align="center"><img src="https://blog.pleets.org/img/articles/iterator_pattern_rules_sample.png" width="483"></p>

For this example we separate the logic for each rule in specific classes listed in `Rules` namespace. Feel free to dig into these classes
before to check the client code.

:large_blue_diamond: Step 4: The client can work with `RuleIterator` and `RuleCollectionAggregate` interfaces. Let's create some rules inside a collection.   

```php
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
```

Now, the client can use the available methods for each interface.

```php
// getIterator() method comes from RuleCollectionAggregate interface.
$iterator = $collection->getIterator();

$results = [];

// valid(), current() and next() comes from RuleIterator interface.
while ($iterator->valid()) {
    $rule = $iterator->current();
    $results[] = $rule->run($value);
    $iterator->next();
}
```

Let's check the test `itIteratesEnabledAndIntegerTypeRulesByPosition`.