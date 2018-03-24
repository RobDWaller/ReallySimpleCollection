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
     * collection
     *
     * @param callable $callback
     * @return Collection
     */
    public function filter(callable $callback): Collection
    {
        return new Collection(array_filter($this->items, $callback));
    }

    /**
     * Map the collection items via a callback / closure and return a new
     * collection
     *
     * @param callable $callback
     * @return Collection
     */
    public function map(callable $callback): Collection
    {
        return new Collection(array_map($callback, $this->items));
    }
}
