<?php

namespace DreamTeam\Framework;

use DreamTeam\Framework\MainObject;

class Application
{
    protected static $_router;

    public static $requestParams = [];

    protected static $_registry = [];

    public static function run()
    {
        self::$_router = Router::init();
        self::$requestParams = self::$_router->getParams();
        $actionClass = '\\DreamTeam\\'
            . ucfirst(self::$_router->getRoute()['module'])
            . '\\Controller\\' . ucfirst(self::$_router->getRoute()['controller'])
            . '\\' . ucfirst(self::$_router->getRoute()['action']);

        if (!class_exists($actionClass)) {
            echo '404';
            return;
        }

        $actionObject = new $actionClass;

        call_user_func([$actionObject, 'execute'], self::$_router->getParams());

        return;
    }

    public static function _set($key, $value = null)
    {
        if (!isset(self::$_registry[$key])) {
            self::$_registry[$key] = $value;
            return;
        }

        throw new \Exception('Registry element with key: ' . $key . ' already exists');
    }

    public static function _get($key)
    {
        if (!isset(self::$_registry[$key])) {
            return false;
        }

        return self::$_registry[$key];
    }

    public static function _has($key)
    {
        return isset(self::$_registry[$key]);
    }

    public static function _unset($key)
    {
        if (!isset(self::$_registry[$key])) {
            throw new \Exception('Registry element with key: ' . $key . ' not exists');
        }

        unset(self::$_registry[$key]);
    }
}