<?php

namespace App\Model;

use JMS\Serializer\Annotation\Type;

class Fixture
{
    #[Type("array")]
    public array $fixture;

    #[Type("App\Model\Teams")]
    public Teams $teams;

    public League $league;

    #[Type("array")]
    public array $score;

    #[Type("array")]
    public array $goals;
}
