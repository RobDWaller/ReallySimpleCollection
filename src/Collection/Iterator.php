<?php

namespace ReallySimple\Collection;

use ReallySimple\Collection\MapReduce;
use Iterator as PHPIterator;
use Countable;

/**
 * Iterator provides core functionality of collection for iterating over and
 * retrieving data from collection.
 *
 * @author Rob Waller <rdwaller1984@googlemail.com>
 */
class Iterator extends MapReduce implements PHPIterator, Countable
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
        parent::__construct($items);

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
     * Return the count of the number of items in the collection array
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
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
     * Check to see if the current array item is valid or isset
     * This method is called after rewind() and next() to check if the current
     * position is valid.
     *
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->items[$this->key()]);
    }
}
