<?php
/**
 *
 */

namespace App\Service;

use Mockery\Exception;

abstract class BaseAbstractService
{
    private static $serviceInstances = [];

    public function __construct($singleton=false)
    {
        if (!$singleton) {
            throw new Exception("Please use " . static::class . ":singleton Initialization object");
        }
    }

    /**
     * @return static
     */
    public static function singleton()
    {
        if (empty(self::$serviceInstances[static::class])) {
            self::$serviceInstances[static::class] = new static(true);
        }
        return self::$serviceInstances[static::class];
    }
}