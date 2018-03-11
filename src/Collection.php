<?php

namespace ReallySimple;

use Iterator;
use Countable;

class Collection implements Iterator, Countable
{
    private $collectionArray;

    public function __construct(array $collectionArray)
    {
        $this->collectionArray = $collectionArray;
    }

    public function current()
    {
        return current($this->collectionArray);
    }

    public function next()
    {
        return next($this->collectionArray);
    }

    public function key()
    {
        return key($this->collectionArray);
    }

    public function rewind()
    {
        reset($this->collectionArray);
    }

    public function valid()
    {
        return isset($this->collectionArray[$this->key()]);
    }

    public function count()
    {
        return count($this->collectionArray);
    }

    public function filter($callback)
    {
        return new Collection(array_filter($this->collectionArray, $callback));
    }

    public function map($callback)
    {
        return new Collection(array_map($callback, $this->collectionArray));
    }

    public function toArray()
    {
        return $this->collectionArray;
    }

    public function first()
    {
        $this->rewind();

        return $this->current();
    }

    public static function make(array $collectionArray)
    {
        return new static($collectionArray);
    }
}
