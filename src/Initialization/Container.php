<?php

namespace Reneknox\ReneknoxPress\Initialization;

use Reneknox\ReneknoxPress\Exceptions\ServiceNotFoundException;

class Container
{
    private array $services = [];
    private array $resolvedServices = [];


    public function bind($service, callable $resolver)
    {
        $this->services[$service] = $resolver;
    }

    public function resolve($service)
    {
        if (isset($this->resolvedServices[$service])) {
            return $this->resolvedServices[$service];
        }
        $serviceResolver = $this->services[$service] ?? null;
        if (!$serviceResolver) {

            throw new ServiceNotFoundException();
        }

        $resolvedService = call_user_func($serviceResolver);
        $this->resolvedServices[$service] = $resolvedService;

        return $resolvedService;
    }

}