<?php

namespace App\Model\Team;

use JMS\Serializer\Annotation\Type;

class Response
{
    public string $get;

    #[Type("array")]
    public array $parameters;

    #[Type("array")]
    public array $errors;

    #[Type("array<App\Model\Team\TeamInfo>")]
    public array $response;
}
