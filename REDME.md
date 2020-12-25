# :pushpin: Rule Iterator Sample in PHP

This sample shows how the iterator pattern can be used to iterate some rules.

# What is the Iterator Pattern :question:

Iterator is a behavioral design pattern that lets you traverse elements of a collection without exposing its underlying representation (list, stack, tree, etc.).

# When to use the Iterator Pattern :question:

- :heavy_check_mark: Use this pattern when the logic of iteration is not usual. You could split responsibilities creating a new class for iteration.
- :heavy_check_mark: d

# What you expect of iterators

- The primary responsibility for a collection is store objects!, not traverse it!.
- All iterators must implement the same interface. This makes the client code compatible with any collection type or any traversal algorithm as long as there’s a proper iterator.