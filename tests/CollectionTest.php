<?php

use ReallySimpleCollection\Collection\Collection;

class CollectionCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testCollection()
    {
        $array = require(__DIR__ . '/UserArray.php');
        
        $collection = new Collection($array);

        $this->assertInstanceOf(Collection::class, $collection);
    }

    public function testCollectionLoop()
    {
        $array = require(__DIR__ . '/UserArray.php');
        
        $collection = new Collection($array);

        foreach ($collection as $key => $value) {
            $this->assertTrue(array_key_exists('surname', $value));
        }
    }

    public function testCollectionFilter()
    {
        $array = require(__DIR__ . '/UserArray.php');

        $collection = new Collection($array);

        $result = $collection->filter(
            function($var){
                return $var['age'] <= 30;
            }
        );

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertEquals(3, $result->count());

        $this->assertEquals('Craig', $result->next()['forename']);
    }

    public function testCollectionMap()
    {
        $array = require(__DIR__ . '/UserArray.php');

        $collection = new Collection($array);

        $result = $collection->map(function($var){
            return $var['forename'] . ' ' . $var['surname'];
        });

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertEquals(5, $result->count());

        $this->assertEquals('John Galt', $result->current());

        $this->assertEquals('Anne Jones', $result->next());
    }

    public function testCollectionAddItem()
    {
        $array = require(__DIR__ . '/UserArray.php');

        $collection = new Collection($array);

        $result = $collection->map(function($var){
            $var['fullname'] = $var['forename'] . ' ' . $var['surname'];
            return $var;
        });

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertEquals(5, $result->count());

        $this->assertEquals('John Galt', $result->current()['fullname']);

        $this->assertEquals('John', $result->current()['forename']);
    }

    public function testCollectionRemoveKey()
    {
        $array = require(__DIR__ . '/UserArray.php');

        $collection = new Collection($array);

        $this->assertTrue(isset($collection->current()['email']));

        $result = $collection->map(function($var){
            unset($var['email']);
            return $var;
        });

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertEquals(5, $result->count());

        $this->assertFalse(isset($result->current()['email']));

        $this->assertFalse(isset($result->next()['email']));
    }

    public function testCollectionStaticMake()
    {
        $array = require(__DIR__ . '/UserArray.php');

        $collection = Collection::make($array);

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertEquals('John', $collection->current()['forename']);
    }
}
