<?php

namespace Belt\Content\Adapters;

/**
 * Class AdapterFactory
 * @package Belt\Content\Adapters
 */
class AdapterFactory
{

    /**
     * @var array
     */
    public static $adapters = [];

    /**
     * @param $driver
     * @return BaseAdapter
     * @throws \Exception
     */
    public static function up($driver = null)
    {

        $driver = $driver ?: static::getDefaultDriver();

        if (isset(static::$adapters[$driver])) {
            return static::$adapters[$driver];
        }

        $adapterClass = config("belt.content.drivers.$driver.adapter");

        if (!$adapterClass || !class_exists($adapterClass)) {
            throw new \Exception('adapter for file driver type not specified or available');
        }

        return static::$adapters[$driver] = new $adapterClass($driver);
    }

    /**
     * Get default attachment driver
     *
     * @return string
     */
    public static function getDefaultDriver()
    {
        if ($driver = config("belt.content.default_driver")) {
            return $driver;
        }

        if ($driver = config("belt.content.drivers.default")) {
            return 'default';
        }

        foreach (config("belt.content.drivers", []) as $key => $driver) {
            return $key;
        }

        return 'default';
    }

}