<?php

namespace Tests;

use ReallySimple\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    private $items;

    public function setUp()
    {
        $this->items = require(__DIR__ . '/UserArray.php');
    }

    public function testCollection()
    {
        $collection = new Collection($this->items);

        $this->assertInstanceOf(Collection::class, $collection);
    }

    public function testCollectionMake()
    {
        $this->assertInstanceOf(Collection::class, Collection::make($this->items));
    }

    public function testCollectionToArray()
    {
        $collection = new Collection($this->items);

        $array = $collection->toArray();

        $this->assertSame($array[1], $this->items[1]);
    }

    public function testCollectionLoop()
    {
        $collection = new Collection($this->items);

        foreach ($collection as $value) {
            $this->assertTrue(array_key_exists('surname', $value));
        }
    }

    public function testCollectionFilter()
    {
        $collection = new Collection($this->items);

        $result = $collection->filter(
            function ($var) {
                return $var['age'] <= 30;
            }
        );

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertSame(3, $result->count());

        $this->assertSame('Craig', $result->next()['forename']);
    }

    public function testCollectionFilterKeys()
    {
        $collection = new Collection($this->items);

        $result = $collection->filterKeys(
            function ($key) {
                return $key >= 2;
            }
        );

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertSame(3, $result->count());

        $this->assertSame('Craig', $result->current()['forename']);
    }

    public function testCollectionFilterKeysValues()
    {
        $collection = new Collection($this->items);

        $result = $collection->filterKeysValues(
            function ($item, $key) {
                return $key >= 2 && $item['age'] >= 20;
            }
        );

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertSame(2, $result->count());

        $this->assertSame('Gary', $result->current()['forename']);
    }

    public function testCollectionMap()
    {
        $collection = new Collection($this->items);

        $result = $collection->map(function ($var) {
            return $var['forename'] . ' ' . $var['surname'];
        });

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertSame(5, $result->count());

        $this->assertSame('Foo Bar', $result->current());

        $this->assertSame('Anne Jones', $result->next());
    }

    public function testCollectionReduce()
    {
        $collection = new Collection($this->items);

        $result = $collection->reduce(function ($carry, $item) {
            $carry[] = [
                'first-name' => $item['forename'],
                'last-name' => $item['surname']
            ];

            return $carry;
        }, []);

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertSame($result->count(), 5);

        $this->assertTrue(isset($result->current()['first-name']));
        $this->assertTrue(isset($result->current()['last-name']));

        $this->assertSame($result->current()['first-name'], 'Foo');

        $this->assertFalse(isset($result->current()['forename']));
        $this->assertFalse(isset($result->current()['surname']));

        $this->assertTrue(isset($result->next()['first-name']));
        $this->assertTrue(isset($result->next()['last-name']));
    }

    public function testCollectionAddItem()
    {
        $collection = new Collection($this->items);

        $result = $collection->map(function ($var) {
            $var['fullname'] = $var['forename'] . ' ' . $var['surname'];
            return $var;
        });

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertSame(5, $result->count());

        $this->assertSame('Foo Bar', $result->current()['fullname']);

        $this->assertSame('Foo', $result->current()['forename']);
    }

    public function testCollectionRemoveKey()
    {
        $collection = new Collection($this->items);

        $this->assertTrue(isset($collection->current()['email']));

        $result = $collection->map(function ($var) {
            unset($var['email']);
            return $var;
        });

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertSame(5, $result->count());

        $this->assertFalse(isset($result->current()['email']));

        $this->assertFalse(isset($result->next()['email']));
    }

    public function testCollectionFirst()
    {
        $collection = new Collection($this->items);

        $this->assertSame('Foo', $collection->first()['forename']);

        $collection->next();
        $collection->next();

        $this->assertSame('Craig', $collection->current()['forename']);
        $this->assertSame('Bar', $collection->first()['surname']);
    }

    public function testCollectionStaticMake()
    {
        $collection = Collection::make($this->items);

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertSame('Foo', $collection->current()['forename']);
    }
}
