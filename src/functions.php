<?php

use Awssat\ArrayHelper\ArrayHelper;


if (! function_exists('arr')) {
    /**
     * A flexible & powerful array manipulation helper
     *
     * @param string $value an array, or multiple parameters to the function 
     *
     * @author abdumu <hi@abdumu.com>
     *
     * @return mixed|Awssat\ArrayHelper\ArrayHelper
     */
    function arr(...$value)
    {
        return new ArrayHelper(...$value);
    }
}
