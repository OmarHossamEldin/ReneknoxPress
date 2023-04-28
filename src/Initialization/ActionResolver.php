<?php

namespace Reneknox\ReneknoxPress\Initialization;

use Reneknox\ReneknoxPress\Server\Request;
use InvalidArgumentException;
use ReflectionFunction;
use ReflectionClass;
class ActionResolver
{
    private $action;

    public function __construct($action)
    {
        $this->action = $action;
    }

    public static function resolve($action)
    {
        return (new ActionResolver($action))->call();
    }

    public function call()
    {
        if (is_array($this->action)) {
            [$class, $method] = $this->action;
            if (!class_exists($class)) throw new InvalidArgumentException();
            $reflectionClass = new ReflectionClass($class);
            if (!$reflectionClass->hasMethod($method)) throw new InvalidArgumentException();
            $class = new $class();
            $args = $this->extract_params(...$reflectionClass->getMethod($method)->getParameters());
            return call_user_func([$class, $method], ...$args);
        }
        if (is_callable($this->action)) {
            $reflection = new ReflectionFunction($this->action);
            $args = $this->extract_params(...$reflection->getParameters());
            return call_user_func($this->action, ...$args);
        }
        throw new InvalidArgumentException();
    }

    private function extract_params(...$params): array
    {
        $initParams = [];
        foreach ($params as $param) {
            if (!class_exists($param->getType()->getName())) {
                throw new InvalidArgumentException();
            }
            $className = $param->getType()->getName();
            if ($className === Request::class) {
                $class = request();
            }
            if ($className !== Request::class) {
                $class = new $className();
            }
            $initParams[] = $class;
        }
        return $initParams;
    }
}