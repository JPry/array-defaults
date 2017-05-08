<?php
/**
 *
 */

namespace JPry;


use PHPUnit\Framework\TestCase;

class DefaultsArrayTest extends TestCase
{

    public function testDefaultSet()
    {
        $a = new DefaultsArray();
        $a->setDefault('foo', 'bar');
        $this->assertArrayNotHasKey('foo', $a);
        $this->assertEquals('bar', $a['foo']);
    }


    public function testDefaultsSet()
    {
        $a = new DefaultsArray();
        $defaults = array(
            'foo' => 'something',
            'bar' => 'another thing',
            'baz' => 'something else',
        );
        $a->setDefaults($defaults);

        foreach ($defaults as $key => $value) {
            $this->assertArrayNotHasKey($key, $a);
            $this->assertEquals($value, $a[$key]);
        }
    }


    public function testValuesAndDefaults()
    {
        $a = new DefaultsArray(
            array(
                'foo' => 'real value',
            )
        );
        $a->setDefault('foo', 'default value');
        $this->assertEquals('real value', $a['foo']);
    }


    public function testRemoveOffset()
    {
        $a = new DefaultsArray();
        $a->setDefault('foo', 'bar');
        unset($a['foo']);
        $this->assertEquals(null, $a['foo']);
    }
}
