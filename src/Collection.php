<?php

namespace ReallySimple;

use Iterator;
use Countable;
use Closure;

/**
 * A very simple collection library that helps you turn arrays into collections.
 * provides lots of useful methods such as first, map, filter, etc.
 *
 * @author Rob Waller <rdwaller1984@googlemail.com>
 */
class Collection implements Iterator, Countable
{

    /**
     * The collection array
     *
     * @var array $items
     */
    private $items;

    /**
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Retun the current item in the array
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->items);
    }

    /**
     * Return the next item in the array
     *
     * @return mixed
     */
    public function next()
    {
        return next($this->items);
    }

    /**
     * Return the key that the array is currently on
     *
     * @return int | string
     */
    public function key()
    {
        return key($this->items);
    }

    /**
     * Reset the collection array to the start
     *
     * @return void
     */
    public function rewind()
    {
        reset($this->items);
    }

    /**
     * Check to see if the current array item is valid or isset
     *
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->items[$this->key()]);
    }

    /**
     * Return the count of the number of items in the collection array
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Filter the collection items via a callback / closure and return a new
     * collection
     *
     * @param Closure $callback
     * @return Collection
     */
    public function filter(Closure $callback): Collection
    {
        return new Collection(array_filter($this->items, $callback));
    }

    /**
     * Map the collection items via a callback / closure and return a new
     * collection
     *
     * @param Closure $callback
     * @return Collection
     */
    public function map(Closure $callback): Collection
    {
        return new Collection(array_map($callback, $this->items));
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
     * Return the first item from the collection
     *
     * @return mixed
     */
    public function first()
    {
        $this->rewind();

        return $this->current();
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
