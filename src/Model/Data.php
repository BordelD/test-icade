<?php

namespace App\Model;

use JMS\Serializer\Annotation\Type;

class Data
{
    #[Type("array")]
    public array $fixture;

    #[Type("App\Model\Teams")]
    public Teams $teams;

    #[Type("array")]
    public array $score;

    #[Type("array")]
    public array $goals;
}
