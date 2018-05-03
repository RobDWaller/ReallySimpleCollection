<?php

namespace ReallySimple\Collection;

use ReallySimple\Collection;

/**
 * Map Reduce provides extended collection functionality such as filter and map.
 *
 * @author Rob Waller <rdwaller1984@googlemail.com>
 */
class MapReduce
{
    /**
     * The collection array
     *
     * @var array $items
     */
    protected $items;

    /**
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Filter the collection items via a callback / closure and return a new
     * collection.
     *
     * @param callable $callback
     * @return Collection
     */
    public function filter(callable $callback): Collection
    {
        return new Collection(array_filter($this->items, $callback));
    }

    /**
     * Filter the collection items via a callback / closure based on the keys
     * and return a new collection.
     *
     * @param callable $callback
     * @return Collection
     */
    public function filterKeys(callable $callback): Collection
    {
        return new Collection(
         array_filter($this->items, $callback, ARRAY_FILTER_USE_KEY)
        );
    }

    /**
     * Filter the collection items via a callback / closure based on the keys
     * and the items, and return a new collection.
     *
     * @param callable $callback
     * @return Collection
     */
    public function filterKeysValues(callable $callback): Collection
    {
        return new Collection(
          array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH)
        );
    }

    /**
     * Map the collection items via a callback / closure and return a new
     * collection. This is based purely on the array values.
     *
     * @param callable $callback
     * @return Collection
     */
    public function map(callable $callback): Collection
    {
        return new Collection(array_map($callback, $this->items));
    }

    /**
     * Reduce the collection of items via a callback / closure and return a new
     * collection.
     *
     * @param callable $callback
     * @param mixed $initial
     * @return Collection
     */
     public function reduce(callable $callback, $initial = null): Collection
     {
         return new Collection(array_reduce($this->items, $callback, $initial));
     }
}
