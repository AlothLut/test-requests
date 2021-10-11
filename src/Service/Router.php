<?php

namespace App\Service;

use App\Microservices\FirstMicroservice;

class Router
{
    public function handle(string $serviceName): mixed
    {
        switch ($serviceName) {
            case "first-microservice":
                return new FirstMicroservice();
            // case "second-microservice":
            //     return new SecondMicroservice();
            default:
                return false;
        }
    }
}
