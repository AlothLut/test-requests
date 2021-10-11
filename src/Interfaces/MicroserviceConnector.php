<?php

namespace App\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface MicroserviceConnector
{
    public function getSettings(): array;

    public function setSettings(Request $request);

    public function connect();
}
