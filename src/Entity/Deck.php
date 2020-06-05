<?php

namespace Entity;

use Entity\User;
use Entity\Clan;
use ludk\Utils\Serializer;

class Deck
{
    public int $id;
    public string $deckName;
    public string $img;
    public string $description;
    public User $user;
    public Clan $clan;

    use Serializer;
}
