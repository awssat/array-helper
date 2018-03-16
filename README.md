# array-helper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/awssat/array-helper.svg?style=flat-square)](https://packagist.org/packages/awssat/array-helper)
[![Build Status](https://img.shields.io/travis/awssat/array-helper/master.svg?style=flat-square)](https://travis-ci.org/awssat/array-helper)


⚡️  A flexible, simple & yet powerful array manipulation helper for PHP. It gives you the magic of method chaining and it's easier and shorter to be included in views. It Supports most of [PHP built-in array functions](http://php.net/manual/en/book.array.php)


```php
arr([' ', 'hi ', null, '  welcome'])->map('trim')->filter()->get()
>> ['hi', 'welcome']
```
## Features
- Support All PHP array functions.
- Short methods names, no need to write "array_" like array_map can be only map(..)
- Array items can be retrireve or updated as properties or keys  [->key or [key] ]
- Support powefull conditional methods. if, else, if{AnyMethod}, endif.
- Support camelCase and snake-case methods name.
- Useful new methods like equal, exists .. etc

## Install/Use
You can install the package via composer locally in your project folder:

```bash
$ composer require awssat/array-helper
```

After installing it, just start using the helper `arr([...])` or `ArrayHelper::make([...])`

## Examples


Use any array function, no need for "array_", if you like it you can use it as in array_filter or arrayFilter .. all will work. 
```php 
$x = arr(['', 'item', null, 'item2'])->filter()->get()
>> ['item', 'item2']
```

You can use conditions, if(function() {...}), if{AnyMethod}, else(), endif()

```php
$x = arr(['item', 'item2', null])
    ->ifContains(null)
        ->filter()
    ->endif()
    ->get()
```
you may also use useful method with `if` like `ifEmpty`, `ifKeyExists` or `ifEqual` etc.


get() will return all items, while get(index) return a item in the array. all() is alias for get(all, true) which will ignore conditions and force return of items anyway.

The example above can be shortened using all() like this:
```php
$x = arr(['item', 'item2', null])
    ->ifContains(null)
        ->filter()
    ->all()
```

You can use do(callback) to run a callback on the array.

```php
$x = arr(['item ', 'item2'])
    ->do(function() {
        return $this->map('trim');
    })
    ->all()
```


PHP built-in array_map, array_walk, array_filter, and array_reduce are the best! 
 
 array_map to loop through all items and change them.
```php 
$array->map(function($item) {
         return 'Hello: '. strip_tags($item) . ' !'; 
    });
```
or for simple functions use, `$array->map('trim')`

array_walk can be used for looping without changing items
```php 
$array->walk(function($item, $key) {
            print "$key: $item<br />\n";
    });
```

or if you want to change the values 
```php
$array->walk(function(&$item, $key) {
            $item = $item * 2;
        });
```

array_filter is great for filtering an array
```php
$array->filter(function($item) {
            return $item > 5;
        });
```
or just `$array->filter()` to remove any value equal to FALSE.




## Tests
Simply use:
```bash
$ composer test
```
## Credits
- [Abdulrahman M.](https://github.com/abdumu)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
