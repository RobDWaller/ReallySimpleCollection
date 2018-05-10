# Really Simple Collection
[![Build Status](https://travis-ci.org/RobDWaller/ReallySimpleCollection.svg?branch=master)](https://travis-ci.org/RobDWaller/ReallySimpleCollection) [![codecov](https://codecov.io/gh/RobDWaller/ReallySimpleCollection/branch/master/graph/badge.svg)](https://codecov.io/gh/RobDWaller/ReallySimpleCollection) [![StyleCI](https://styleci.io/repos/90523633/shield?branch=master)](https://styleci.io/repos/90523633)

A very simple PHP collection library that helps you turn arrays into collections. Provides lots of useful methods such as first, map, filter, etc.

## Usage

To use the collection just pass an array into the new instance of the collection class.

```php

use ReallySimple\Collection;

$items = ['item1', 'item2', 'item3'];

$collection = new Collection($items);

echo $collection->count(); // Will Output 3.
```

You can also create the collection statically.

```php

use ReallySimple\Collection;

$items = ['item1', 'item2', 'item3'];

$collection = Collection::make($items);

echo $collection->count(); // Will Output 3.
```

## Methods Available

The following methods are currently available for this collection library.

```php
// Return the number of items in the collection
$collection->count(): int;

// Return the current item the collection pointer is on
$collection->current();

// Filter the collection based on the values and return a new collection
$collection->filter(callable $callback): Collection;

// Filter the collection based on the keys and return a new collection
$collection->filterKeys(callable $callback): Collection;

// Filter the collection based on the keys and values and return a new collection
$collection->filterKeysValues(callable $callback): Collection;

// Return the first item from the collection
$collection->first();

// Return the current key the collection pointer is on
$collection->key();

// Map the collection and return a new collection
$collection->map(callable $callback): Collection;

// Move the collection point forward by one and return value
$collection->next();

// Return the collection pointer to the start of the collection
$collection->rewind();

// Reduce the collection and return a new collection
$collection->reduce(callable $callback, $initial = null): Collection;

// Return the collection as an array
$collection->toArray(): array;

// Check the collection key is valid
$collection->valid(): bool;
```

## Author

- Rob Waller
- [@RobDWaller](https://twitter.com/RobDWaller)
- [Website](https://rbrt.wllr.info)
