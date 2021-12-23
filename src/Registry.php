<?php

namespace App;

class Registry
{
    /**
     * All registered keys.
     *
     * @var array
     */
    protected static $services = [];

    /**
     * Bind a new key/value into the container.
     *
     * @param  string $key
     * @param  mixed  $value
     */
    public static function bind($key, $value)
    {
        static::$services[$key] = $value;
    }

    /**
     * Retrieve a value from the registry.
     *
     * @param  string $key
     */
    public static function get($key)
    {
        if (! array_key_exists($key, static::$services)) {
            throw new \Exception("No {$key} is bound in the container.");
        }

        return static::$services[$key];
    }
}