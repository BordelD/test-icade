<?php

namespace App\Model;

use JMS\Serializer\Annotation\Type;

class Response
{
    public string $get;

    #[Type("array")]
    public array $parameters;

    #[Type("array")]
    public array $errors;

    #[Type("array<App\Model\Fixture>")]
    public array $response;
}
