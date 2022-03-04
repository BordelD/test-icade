<?php

namespace App\Model\Event;

use App\Model\Team;

class Event
{
    public Team $team;
    public string $type;
    public string $detail;
    public ?string $comments;
}
