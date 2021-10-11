<?php

namespace App\Microservices;

use App\Interfaces\MicroserviceConnector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class FirstMicroserviceConnector implements MicroserviceConnector
{
    private $secrets;

    private $constraint;

    private $response;

    public function __construct(string $secrets)
    {
        $this->secrets = $secrets;
    }

    public function connect()
    {
        // connecting with $this->secrets and receiving a response from microservice
        // deserialize data if gRPC
        // in this abstract example, we return a valid response:
        $this->response = [
            "field1" => "string",
            "field2" => true,
            "field3" => [
                "string1",
                "string2",
            ],
        ];
        $this->validate($this->response);
    }

    public function getSettings(): array
    {
        $this->connect();
        if (0 === count($this->errors)) {
            return $this->response;
        } else {
            return $this->gerErrors();
        }
    }

    public function setSettings(Request $request)
    {
        $settings = $request->get("settings")["settings"];
        $this->validate(json_decode($settings, true));
        if (0 === count($this->errors)) {
            return ["sucess" => true];
        } else {
            return $this->gerErrors();
        }
    }

    private function setConstraint(): void
    {
        $this->constraint = new Assert\Collection([
            'field1' => new Assert\Type(['type' => 'string']),
            'field2' => new Assert\Type(['type' => 'bool']),
            'field3' => new Assert\Collection([
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'string']),
            ]),
        ]);
    }

    private function validate(array $settings): void
    {
        $this->setConstraint();
        $validator = Validation::createValidator();
        $this->errors = $validator->validate($settings, $this->constraint);
    }

    private function gerErrors(): array
    {
        return [
            "errors:" => $this->errors[0]->getMessage(),
            "field" => $this->errors[0]->getPropertyPath(),
        ];
    }
}
