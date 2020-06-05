<?php

namespace Entity;

use ludk\Utils\Serializer;

class Clan
{
    public int $id;
    public string $clanName;

    use Serializer;
};
