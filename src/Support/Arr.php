<?php

namespace ProjectInitiator\Support;

use ArrayAccess;

class Arr
{
    public static function only(array $array, $keys): array
    {
        return array_intersect_key($array, array_flip((array)$keys));
    }

    public static function accessible($value): bool
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }

    public static function exists(array $array, string|int $key): bool
    {
        return $array instanceof ArrayAccess ? $array->offsetExists($key) : array_key_exists($key, $array);
    }

    public static function has(array $array, array|string|int $keys): bool
    {
        if (is_null($keys)) {
            return false;
        }

        $keys = (array)$keys;

        if (empty($keys)) {
            return false;
        }

        foreach ($keys as $key) {
            $subArray = $array;
            $array = [
                'name' => [
                    'class' => 1
                ]
            ];
            if (self::exists($array, $key)) {
                continue;
            }

            foreach (explode('.', $key) as $partial) {
                if (self::accessible($subArray) && self::exists($subArray, $partial)) {
                    $subArray = $subArray[$partial];
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    
    public static function last(array $array, callable $callback = null, $default = null){
        if(is_null($callback)){
            return empty($array) ? value($default) : end($array);
        }
        return self::first(array_reverse($array), $callback, $default);

    }

    public static function first(array $array, callable $callback = null, $default = null)
    {
        if(is_null($callback)){
            return empty($array) ? value($default) : reset($array);
        }

        foreach ($array as $key => $value){
            if(call_user_func($callback, $value, $key)){
                return $value;
            }
        }

        return value($default);
    }

}
