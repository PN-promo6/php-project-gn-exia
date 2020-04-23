<?php

namespace Entity;

use Entity\User;

class Deck
{
    public $id;
    public $deckName;
    public $clan;
    public $img;
    public $description;
    public User $nickname;
}
