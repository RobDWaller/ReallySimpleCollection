# Really Simple Collection

A very simple PHP collection library that helps you turn arrays into collections. Provides lots of useful methods such as first, map, filter, etc.

## Usage

To use the collection is very simple, just pass an array into the new instance of the collection class.

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
$collection->count();

$collection->current();

$collection->filter();

$collection->first();

$collection->key();

$collection->map();

$collection->next();

$collection->rewind();

$collection->toArray();

$collection->valid();
```

## Author

- Rob Waller
- [@RobDWaller](https://twitter.com/RobDWaller)
- [Website](https://rbrt.wllr.info)
