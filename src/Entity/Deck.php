<?php

namespace Entity;

use Entity\User;
use ludk\Utils\Serializer;

class Deck
{
    public $id;
    public $deckName;
    public $clan;
    public $img;
    public $description;
    public User $user;

    use Serializer;
}
