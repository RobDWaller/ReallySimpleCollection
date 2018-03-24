<?php

namespace ReallySimple;

use ReallySimple\Collection\Iterator;

/**
 * A very simple collection library that helps you turn arrays into collections.
 * provides lots of useful methods such as first, map, filter, etc.
 *
 * Collection class provides simple interface for building collection and
 * returning array data. Extends Iterator for core functionality and MapReduce
 * for extended functionality such as mapping and filtering.
 *
 * @author Rob Waller <rdwaller1984@googlemail.com>
 */
class Collection extends Iterator
{
    /**
     * @param array $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    /**
     * Return the collection as an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->items;
    }

    /**
     * Build the collection statically
     *
     * @return Collection
     */
    public static function make(array $items): Collection
    {
        return new static($items);
    }
}
