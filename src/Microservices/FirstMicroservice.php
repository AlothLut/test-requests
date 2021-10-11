<?php

namespace App\Microservices;

use App\Service\Settings;
use App\Interfaces\MicroserviceConnector;

class FirstMicroservice extends Settings
{
    private $secrets;

    public function __construct(string $secrets = "secret-token")
    {
        $this->secrets = $secrets;
    }

    public function getMicroservice(): MicroserviceConnector
    {
        return new FirstMicroserviceConnector($this->secrets);
    }
}