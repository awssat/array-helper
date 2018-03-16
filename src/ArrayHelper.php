<?php

namespace Awssat\ArrayHelper;


/**
 * @method \Awssat\ArrayHelper\ArrayHelper push(mixed $value1 [, mixed $... ]) 
 * @method \Awssat\ArrayHelper\ArrayHelper prepend(mixed $value1 [, mixed $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper values()
 * @method \Awssat\ArrayHelper\ArrayHelper keys([ mixed $search_value [, bool $strict]])
 * @method int count([int $mode])
 * @method bool empty()
 * @method bool contains(mixed $needle [, mixed $needle2])
 * @method bool exists(mixed $needle [, bool $strict])
 * @method \Awssat\ArrayHelper\ArrayHelper shuffle()
 * @method bool key_exists(mixed $key)
 * @method \Awssat\ArrayHelper\ArrayHelper map(callable $callback)
 * @method \Awssat\ArrayHelper\ArrayHelper flip()
 * @method \Awssat\ArrayHelper\ArrayHelper diff(array $array2 [, array $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper fill_keys(array $keys , mixed $value)
 * @method \Awssat\ArrayHelper\ArrayHelper fill(int $start_index , int $num , mixed $value)
 * @method \Awssat\ArrayHelper\ArrayHelper filter([ callable $callback [, int $flag]])
 * @method \Awssat\ArrayHelper\ArrayHelper combine_keys(array $keys)
 * @method \Awssat\ArrayHelper\ArrayHelper combine_values(array $values)
 * @method \Awssat\ArrayHelper\ArrayHelper count_values()
 * @method \Awssat\ArrayHelper\ArrayHelper chunk(int $size [, bool $preserve_keys])
 * @method mixed pop()
 * @method mixed shift()
 * @method \Awssat\ArrayHelper\ArrayHelper intersect_assoc(array $array2 [, array $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper intersect_key(array $array2 [, array $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper intersect_uassoc(array $array2 [, array $... ], callable $key_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper intersect_ukey(array $array2 [, array $... ], callable $key_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper array_intersect(array $array2 [, array $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper change_key_case([int $case])
 * @method \Awssat\ArrayHelper\ArrayHelper column(mixed $column_key [, mixed $index_key])
 * @method \Awssat\ArrayHelper\ArrayHelper diff_assoc(array $array2 [, array $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper diff_key(array $array2 [, array $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper diff_uassoc(array $array2 [, array $... ], callable $key_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper diff_ukey(array $array2 [, array $... ], callable $key_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper merge_recursive(array $array2 [ array $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper merge(array $array2 [ array $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper multisort([mixed $array1_sort_order [, mixed $array1_sort_flags [, mixed $... ]]])
 * @method \Awssat\ArrayHelper\ArrayHelper pad(int $size , mixed $value)
 * @method number product()
 * @method mixed rand([int $num])
 * @method mixed reduce(callable $callback [, mixed $initial])
 * @method \Awssat\ArrayHelper\ArrayHelper replace_recursive(array $array2 [, array $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper replace(array $array2 [, array $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper reverse([bool $preserve_keys])
 * @method mixed search(mixed $needle , [, bool $strict])
 * @method \Awssat\ArrayHelper\ArrayHelper slice(int $offset [, int $length [, bool $preserve_keys]])
 * @method \Awssat\ArrayHelper\ArrayHelper splice(int $offset [, int $length [, mixed $replacement]])
 * @method number sum()
 * @method \Awssat\ArrayHelper\ArrayHelper udiff_assoc(callable $value_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper udiff_uassoc(callable $value_compare_func , callable $key_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper udiff(callable $value_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper uintersect_assoc(callable $value_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper uintersect_uassoc(callable $value_compare_func , callable $key_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper uintersect(callable $value_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper unique([int $sort_flags])
 * @method \Awssat\ArrayHelper\ArrayHelper unshift(mixed $value1 [, mixed $... ])
 * @method \Awssat\ArrayHelper\ArrayHelper walk_recursive(callable $callback [, mixed $userdata])
 * @method \Awssat\ArrayHelper\ArrayHelper walk(callable $callback [, mixed $userdata])
 * @method \Awssat\ArrayHelper\ArrayHelper arsort([int $sort_flags])
 * @method \Awssat\ArrayHelper\ArrayHelper asort([int $sort_flags])
 * @method \Awssat\ArrayHelper\ArrayHelper krsort([int $sort_flags])
 * @method \Awssat\ArrayHelper\ArrayHelper ksort([int $sort_flags])
 * @method \Awssat\ArrayHelper\ArrayHelper rsort([int $sort_flags])
 * @method \Awssat\ArrayHelper\ArrayHelper sort([int $sort_flags])
 * @method \Awssat\ArrayHelper\ArrayHelper uasort(callable $value_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper uksort(callable $value_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper usort(callable $value_compare_func)
 * @method \Awssat\ArrayHelper\ArrayHelper natcasesort()
 * @method \Awssat\ArrayHelper\ArrayHelper natsort()
 * @method bool in_array(mixed $needle , [, bool $strict])
 * @method bool equal($array2)
 * @method \Awssat\ArrayHelper\ArrayHelper ifHasChanged()
 */
class ArrayHelper implements \Countable, \ArrayAccess, \IteratorAggregate, \Serializable, \JsonSerializable
{
    protected $data = [];
    protected $conditionDepth = 0;
    protected $falseIfTriggered = [];
    protected $falseElseTriggered = [];
    protected $isIf = [];
    protected $isElse = [];
    protected $insideIfCondition = false;
    protected $dataHasChanged = false;
    
    protected $aliasMethods = [
        'exists' => 'in_array',
        'prepend' => 'array_unshift',
    ];


    /**
     * Initiate the class.
     *
     * @param array $value an array
     */
    public function __construct()
    {
        if(func_num_args() > 1) {
            $this->data = func_get_args();
        } else if(func_num_args() == 1) {
            $this->set(func_get_arg(0));
        }

        return $this;
    }

    static public function make()
    {
        return (new static(func_get_args()));
    }

    /**
     * The door to the magic.
     *
     * @param string $methodName name of called method
     * @param array  $arguments  arguments of called method
     *
     * @return void
     */
    public function __call($methodName, $arguments)
    {
        // in case of if{method}()
        if (substr($methodName, 0, 2) === 'if') {
            $methodName = lcfirst(ltrim(substr($methodName, 2), '_'));

            return $this->if(
                function () use ($methodName, $arguments) {
                    return $this->$methodName(...$arguments);
                }
            );
        }

        //nothing to do, false condition was triggered
        if ($this->skipIfTriggered() && !$this->insideIfCondition) {
            return $this;
        }

        $snake_method_name = strtolower(preg_replace('/([a-z]{1})([A-Z]{1})/', '$1_$2', $methodName));

        if(array_key_exists($snake_method_name, $this->aliasMethods)) {
            $snake_method_name = $this->aliasMethods[$snake_method_name];
        }

       if (in_array($snake_method_name, ['combine_keys', 'combine_values', 'equal', 'contains', 'empty'])) {
           return $this->do(function() use($snake_method_name, $arguments) {

                if($snake_method_name == 'combine_keys') {
                    return array_combine($arguments[0], $this->data);
                }

                if ($snake_method_name == 'combine_values') {
                    return array_combine($this->data, $arguments[0]);
                }
            
                if ($snake_method_name == 'equal') {
                    return $this->equal($this->data, $arguments[0]);
                }

                if ($snake_method_name == 'contains' && sizeof($arguments)) {
                    foreach($arguments as $argument) {
                        if(! in_array($argument, $this->data)) {
                            return false;
                        }
                    }

                    return true;
                }

                if ($snake_method_name == 'empty') {
                    return count($this->data) === 0;
                }

             });

       } else if (function_exists('array_'.$snake_method_name)) {
            return $this->do('array_'.$snake_method_name, ...$arguments);
        } else if (function_exists($snake_method_name)) {
           return $this->do($snake_method_name, ...$arguments);
       } else {
            // Couldn't find either?
            throw new \BadMethodCallException('Method ('.$methodName.') does not exists!');
        }

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param int|null $index
     * @param boolean $ignoreConditions
     * @return array|self
     */
    public function get($index = null, $ignoreConditions = false)
    {
        if(! is_null($index)) {
            return $this->data[$index];
        }

        if ($this->skipIfTriggered() && ! $ignoreConditions) {
            return $this;
        }

        return $this->data;
    }

    /**
     * get all items ignoring the current conditions
     * 
     * @return array
     */
    public function all()
    {
        return $this->get(null, true);
    }

    /**
     * set current array.
     *
     * @return self
     */
    public function set($value)
    {
        if ($this->skipIfTriggered()) {
            return $this;
        }
        
        $oldData = $this->data;

        if (is_array($value)) {
            $this->data = $value;
        } elseif ($value instanceof self) {
           $this->data = $value->get(null, true);
        } elseif ($value instanceof JsonSerializable) {
            $this->data = $value->jsonSerialize();
        } elseif ($value instanceof Traversable) {
            $this->data = iterator_to_array($value);
        } else {
            //is it json?
            $decodedValue = json_decode($value, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->data = (array) $decodedValue;
            } else {
                $this->data = (array) $value;
            }
        }

        $this->dataHasChanged = ! $this->equal($oldData, $this->data);

        unset($oldData);

        return $this;
    }

    /**
     * Tap! Tap!
     *
     * @param callable $callable Anonymous function
     *
     * @return self
     */
    public function tap($callable)
    {
        $callable($this->data);

        return $this;
    }

    protected function skipIfTriggered($condition = null)
    {
        if ($this->conditionDepth === 0) {
            return false;
        }

        if ($condition === null) {
            $condition = $this->conditionDepth;
            if ($condition > 1 && $this->skipIfTriggered($condition - 1)) {
                return true;
            }
        }

        $isIf = $this->isIf[$condition] && $this->falseIfTriggered[$condition];
        $isElse = $this->isElse[$condition] && $this->falseElseTriggered[$condition];

        return $isIf || $isElse;
    }

    /**
     * Execute a callable on the array.
     *
     * @param callable $callable
     * @param mixed    ...$args
     *
     * @return mixed|self|Illuminate\Support\Str
     */
    public function do($callable, ...$args)
    {
        if ($this->skipIfTriggered() && !$this->insideIfCondition) {
            return $this;
        }

        if ($callable instanceof \Closure) {
            //anonymous

            $callable = $callable->bindTo($this);
            $result = ($callable->bindTo($this))($this->data);

            if (\is_object($result) && is_a($result, __CLASS__)) {
                $result = $result->get();
            } elseif ($result === null) {
                return $this;
            }
        } elseif (function_exists($callable)) {
            //regular functions

            //If a regular function is called, then we get its information
            //and where is the position of the array value among the params
            $functionInfo = new \ReflectionFunction($callable);

            if ($functionInfo->getNumberOfParameters() > 1) {
                $stringIndex = -1;

                $exceptionIndices = [];

                if (! array_key_exists($callable, $exceptionIndices)) {
                    foreach ($functionInfo->getParameters() as $order => $arg) {
                        //no: value
                        // if ($callable === 'array_intersect') {
                        //     var_dump($arg->name);
                        // }

                        if (in_array($arg->name, ['arrays', 'array', 'array1', 'arr1', 'input', 'arg', 'haystack', 'search'])) {
                            $stringIndex = $order;
                            break;
                        }
                    }
                } else {
                    $stringIndex = $exceptionIndices[$callable];
                }

                if ($stringIndex !== -1) {
                    //add the string param in the right order
                    array_splice($args, $stringIndex, 0, [&$this->data]);
                }

                $result = $callable(...$args);
            } elseif ($functionInfo->getNumberOfParameters() == 1) {
                $result = $callable($this->data);
            } else {
                $result = $callable();
            }
        } else {
            throw new \InvalidArgumentException('Method (do) can only receive anonymous functions or regular (built-in/global) functions!');
        }

        if (
            gettype($result) !== 'array' &&
            !(isset($this->isIf[$this->conditionDepth]) && $this->isIf[$this->conditionDepth]) &&
            !(isset($this->isElse[$this->conditionDepth]) && $this->isElse[$this->conditionDepth])
        ) {

            if(in_array($callable, [
            'array_multisort', 'array_push', 'array_unshift', 'array_walk', 'array_walk_recursive',
            'arsort', 'asort', 'krsort', 'ksort', 'rsort', 'sort', 'uasort', 'uksort', 'usort', 'natcasesort',
            'natsort', 'shuffle',
            ])) {
                return $this;
            }
    
            return $result;
        }

        if ($this->insideIfCondition) {
            return $result;
        }

        $oldData = $this->data;

        if(! ($callable instanceof \Closure) && in_array($callable, ['array_fill_keys', 'array_fill']) && is_array($result)) {
            $this->data = $this->data + $result;
        } else {
            $this->data = $result;
        }

        $this->dataHasChanged = ! $this->equal($oldData, $this->data);
        
        unset($oldData);

        return $this;
    }

    /**
     * If condition, to end the condition use endif().
     *
     * @param callable $callable
     * @param mixed    ...$args
     *
     * @return self
     */
    public function if($callable, ...$args)
    {
        $this->conditionDepth++;

        $this->falseIfTriggered[$this->conditionDepth] = false;
        $this->falseElseTriggered[$this->conditionDepth] = false;
        $this->isIf[$this->conditionDepth] = true;
        $this->isElse[$this->conditionDepth] = false;

        $lastData = $this->data;

        $this->insideIfCondition = true;

        $result = $this->do($callable, ...$args);


        if ($result instanceof self && $this->equal($lastData, $this->data)) {
            $this->falseIfTriggered[$this->conditionDepth] = true;
        } elseif (is_array($result) && $this->equal($lastData, $result)) {
            $this->falseIfTriggered[$this->conditionDepth] = true;
        } elseif ($result instanceof \Traversable && count($result) == 0) {
            $this->falseIfTriggered[$this->conditionDepth] = true;
        } elseif ($result === false) {
            $this->falseIfTriggered[$this->conditionDepth] = true;
        }

        $this->insideIfCondition = false;

        return $this;
    }

    protected function equal($array1, $array2) 
    {
        return is_array($array1) && is_array($array2)
            && count($array1) == count($array2)
            && array_diff($array1, $array2) === array_diff($array2, $array1);
    }

    /**
     * did last method changed the array value
     *
     * @return bool
     */
    public function hasChanged()
    {
        return $this->dataHasChanged;
    }

    /**
     * End the If condition.
     *
     * @return self
     */
    public function endif()
    {
        unset(
            $this->falseIfTriggered[$this->conditionDepth],
            $this->falseElseTriggered[$this->conditionDepth],
            $this->isIf[$this->conditionDepth],
            $this->isElse[$this->conditionDepth]
        );

        $this->conditionDepth--;

        return $this;
    }

    /**
     * Else case of an initiated condition.
     *
     * @return self
     */
    public function else()
    {
        $this->isIf[$this->conditionDepth] = false;
        $this->isElse[$this->conditionDepth] = true;

        if (!$this->falseIfTriggered[$this->conditionDepth]) {
            $this->falseElseTriggered[$this->conditionDepth] = true;
        }

        $this->falseIfTriggered[$this->conditionDepth] = false;

        return $this;
    }


    /**
     * Return the length of the current array.
     *
     * @return int
     */
    public function count()
    {
        return is_array($this->data) ? count($this->data) : 0;
    }

    /**
     * Get the current array as string (json).
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->data);
    }

    public function __debugInfo()
    {
        return ['items' => $this->data];
    }

    /**
     * unique hash of the array
     *
     * @return string
     */
    public function __hash()
    {
        return sha1($this->__toString());
    }

    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    public function offsetSet($offset, $value) 
    {
        $this->__set($offset, $value);
    }

    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }

    public function offsetUnset($offset)
    {
        $this->__unset($offset);
    }

    public function __get($index)
    {
        if (! is_null($index)) {
            return $this->get($index);
        }

        return null;
    }

    public function __set($index, $value)
    {
        if($this->data[$index] !== $value) {
            $this->dataHasChanged = true;
        }

        $this->data[$index] = $value;
    }

    public function __isset($index)
    {
        return isset($this->data[$index]);
    }

    public function __unset($index)
    {
        if (isset($this->data[$index])) {
            $this->dataHasChanged = true;
        }

        unset($this->data[$index]);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    public function serialize()
    {
        return serialize($this->__toString());
    }

    public function unserialize($data)
    {
        $this->set(unserialize($data));

        return $this;
    }

    public function jsonSerialize()
    {
        return $this->data;
    }
}
