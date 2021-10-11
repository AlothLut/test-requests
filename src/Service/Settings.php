<?php

namespace App\Service;

use App\Interfaces\MicroserviceConnector;
use Symfony\Component\HttpFoundation\Response;

abstract class Settings
{
    abstract public function getMicroservice(): MicroserviceConnector;

    public function get(): array
    {
        $microservice = $this->getMicroservice();
        return $microservice->getSettings();
    }

    public function set($request): array
    {
        $microservice = $this->getMicroservice();
        return $microservice->setSettings($request);
    }

    public function makeResponse(array $result): Response
    {
        $response = new Response();
        $response->setContent(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}