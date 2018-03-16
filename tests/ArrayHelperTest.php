<?php

namespace Awssat\ArrayHelper\Test;

use PHPUnit\Framework\TestCase;

class ArrayHelperTest extends TestCase
{
    /** @test */
    public function empty_arr_return_an_instance_array_helper()
    {
        $this->assertEquals('Awssat\ArrayHelper\ArrayHelper', \get_class(arr()));
    }

    /** @test */
    public function arr_can_take_multiple_parameters()
    {
        $this->assertEquals(['a', 'b'], arr('a', 'b')->get());
    }

    /** @test */
    public function arr_can_take_json()
    {
        $value = ['who', 'are', 'you'];
        $json = json_encode($value);
        $this->assertEquals($value, arr($json)->get());
    }

    /** @test */
    public function arr_support_json_serialize()
    {
        $value = ['are', 'you', 'json'];
        $this->assertEquals(json_encode($value), json_encode(arr($value)));
    }

    /** @test */
    public function arr_convert_to_json_when_converted_to_string()
    {
        $value = ['are', 'you', 'string'];
        $this->assertEquals(json_encode($value), (string) arr($value));
    }


    /** @test */
    public function does_arr_has_methods()
    {
        $this->assertTrue(
                method_exists(get_class(arr()), 'if'),
                'arr()->if() does not exist!'
            );
    }

    /** @test */
    public function arr_convert_short_array_functions_name_to_original()
    {
        $this->assertEquals('HI', arr([' hi '])->map('trim')->map('strtoupper')->get(0));
    }

    /** @test */
    public function arr_equal_method()
    {
        $this->assertTrue(arr(['<tag>hi<tag>', 'welcome'])->map('strip_tags')->equal(['hi', 'welcome']));
    }

    /** @test */
    public function array_functions_that_normally_returns_bool_now_returns_an_object()
    {
        $this->assertEquals('object', gettype(arr('one', 'two')->shuffle()));
    }

    /** @test */
    public function arr_get_method_type_is_an_array()
    {
        $this->assertEquals('array', gettype(arr('item1', 'item2')->get()));
    }

    /** @test */
    public function tap_does_not_change_value()
    {
        $this->assertEquals(
            'hi',
             arr(['hi'])->tap(function ($value) {
                 $this->data = [];
                 $value = [];
                 return [];
             })->get(0)
        );
    }

    /** @test */
    public function do_can_bring_magic()
    {
        $this->assertEquals(
            'hi',
             arr(['<html>hi</html>'])
             ->do(function () {
                 return $this->map('strip_tags');
             })
             ->get(0)
        );
    }

    /** @test */
    public function map_works_fine()
    {
        $this->assertEquals(
            ['a!', 'b!'],
            arr(['a', 'b'])->map(function ($item) {
                return $item . '!'; 
            })
            ->get()
        );
    }

    /** @test */
    public function walk_works_fine_too()
    {
        $this->assertEquals(
            ['a!', 'b!'],
            arr(['a', 'b'])->walk(function (&$item) {
                $item = $item . '!'; 
            })
            ->get()
        );
    }

    /** @test */
    public function filter_works_fine()
    {
        $this->assertEquals(
            ['a', 'b'],
            arr(['a', 'b', false, null, '', 0])->filter()
            ->get()
        );
    }

    /** @test */
    public function filter_works_fine2()
    {
        $this->assertEquals(
            ['a', 'b'],
            arr(['a', 'b', 'c'])->filter(function($item){
                return $item !== 'c';
            })
            ->get()
        );
    }

    /** @test */
    public function test_if_with_built_in_functions()
    {
        $result = arr('item1', 'item2')
                    ->ifCount()
                        ->map('strtoupper')
                    ->endif();

        $this->assertEquals(['ITEM1', 'ITEM2'], $result->get());
    }

    /** @test */
    public function test_if2_with_built_in_functions()
    {
        $result = arr(['hi', 'welcome', null])
                    ->ifContains(null)
                        ->filter();

        $this->assertEquals(['hi', 'welcome'], $result->all());
    }

    /** @test */
    public function test_if_endif_with_built_in_functions()
    {
        $result = arr([' ITEM1 ', ' ITEM2 '])
                    ->ifEmpty()
                        ->map('strtolower')
                    ->endif()
                       ->map('trim')
                    ->get();

        $this->assertEquals(['ITEM1', 'ITEM2'], $result);
    }

    /** @test */
    public function test_if_else_endif_with_built_in_functions()
    {
        $result = arr([' hi ', ' welcome '])
                    ->ifContains('hi')
                        ->map('strtolower')
                    ->else()
                         ->map('strtoupper')
                    ->endif()
                    ->map('trim')
                    ->get();
        

        $this->assertEquals(['HI', 'WELCOME'], $result);
    }

    /** @test */
    public function test_built_in_functions()
    {
        foreach ([
                'diff' => [
                    ['apple', 'orange'], //array
                     [['orange']], //params
                     ['apple'],     //expectted
                    ],
                'intersect' => [
                    ['orange', 'apple'], //array
                     [['orange', 'kiwi']], //params
                     ['orange'],     //expectted
                    ],
                'slice' => [
                    ['a', 'b', 'c', 'd'],
                     [2],
                     ['c', 'd'],
                ],
                'pad' => [
                    ['a', 'b', 'c', 'd'],
                    [5, 'e'],
                    ['a', 'b', 'c', 'd', 'e'],
                ],
                'fill' => [
                    ['a', 'b', 'c', 'd'],
                    [4, 1, 'e'],
                    ['a', 'b', 'c', 'd', 'e'],
                ],
                'sort' => [
                    ['d', 'a', 'c', 'b'],
                    [],
                    ['a', 'b', 'c', 'd'],
                ],
           ] as $func => $data) {
            $this->assertEquals($data[2], arr($data[0])->{$func}(...$data[1])->get());
        }
    }


    /** @test */
    public function ar_throw_exception_if_given_wrong_method()
    {
        $this->expectException(\BadMethodCallException::class);
        arr('If it is complicated, then you are doing it wrong!')->callMama();
    }

    /** @test */
    public function arr_do_throw_exception_if_given_no_function()
    {
        $this->expectException(\InvalidArgumentException::class);
        arr(['Go Duck Yourself'])->do('hi');
    }

    /** @test */
    public function arr_can_be_counted()
    {
        $this->assertEquals(1, count(arr('Nomad')->sort()));
    }
}
