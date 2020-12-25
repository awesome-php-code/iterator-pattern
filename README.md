# :pushpin: Rule Iterator Sample in PHP

This sample shows how the iterator pattern can be used to iterate some rules :pencil:.

# What is the Iterator Pattern :question:

Iterator is a behavioral design pattern that lets you traverse elements of a collection without exposing its underlying representation (list, stack, tree, etc.).

# When to use the Iterator Pattern :question:

:heavy_check_mark: Use this pattern when the logic of iteration is not usual. You could split responsibilities creating a new class for iteration.

:heavy_check_mark: Use this pattern to reduce duplicated code. When no iterator is defined the code of iteration often is duplicated!.

:heavy_check_mark: Use the Iterator when you want your code to be able to traverse different data structures or when types of these structures are unknown beforehand.

# What you expect of iterators

:white_check_mark: The primary responsibility for a collection is store objects!, not traverse it!.

:white_check_mark: All iterators must implement the same interface. This makes the client code compatible with any collection type or any traversal algorithm as long as there’s a proper iterator.

:white_check_mark: The pattern provides a couple of generic interfaces for both collections and iterators.

For more information about this pattern you can check [this page](https://refactoring.guru/design-patterns/iterator).
The following is the implementation of this pattern to solve a basic problem of iterating rules.