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

    public function testCollectionLoop()
    {
        $collection = new Collection($this->items);

        foreach ($collection as $key => $value) {
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

        $this->assertEquals(3, $result->count());

        $this->assertEquals('Craig', $result->next()['forename']);
    }

    public function testCollectionMap()
    {
        $collection = new Collection($this->items);

        $result = $collection->map(function ($var) {
            return $var['forename'] . ' ' . $var['surname'];
        });

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertEquals(5, $result->count());

        $this->assertEquals('Foo Bar', $result->current());

        $this->assertEquals('Anne Jones', $result->next());
    }

    public function testCollectionAddItem()
    {
        $collection = new Collection($this->items);

        $result = $collection->map(function ($var) {
            $var['fullname'] = $var['forename'] . ' ' . $var['surname'];
            return $var;
        });

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertEquals(5, $result->count());

        $this->assertEquals('Foo Bar', $result->current()['fullname']);

        $this->assertEquals('Foo', $result->current()['forename']);
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

        $this->assertEquals(5, $result->count());

        $this->assertFalse(isset($result->current()['email']));

        $this->assertFalse(isset($result->next()['email']));
    }

    public function testCollectionFirst()
    {
        $collection = new Collection($this->items);

        $this->assertEquals('Foo', $collection->first()['forename']);

        $collection->next();
        $collection->next();

        $this->assertEquals('Craig', $collection->current()['forename']);
        $this->assertEquals('Bar', $collection->first()['surname']);
    }

    public function testCollectionStaticMake()
    {
        $collection = Collection::make($this->items);

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertEquals('Foo', $collection->current()['forename']);
    }
}
