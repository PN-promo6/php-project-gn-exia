<?php

namespace Controller;

class HomeController
{
    public function display()
    {
        global $userRepo;
        global $deckRepo;
        global $clanRepo;

        $decks = array();

        if (isset($_GET['search'])) {

            $search = $_GET['search'];

            if (strpos($search, "@") === 0) {

                $nickname = substr($search, 1);

                $users = $userRepo->findBy(array("nickname" => $nickname));

                if (count($users) == 1) {

                    $user = $users[0];

                    $decks = $deckRepo->findBy(array("user" => $user->id));
                }
            } elseif (strpos($search, "#") === 0) {

                $clan = substr($search, 1);

                $decks = $deckRepo->findBy(array("clan" => $clan));
            } else {

                $decks = $deckRepo->findBy(array("description" => $_GET['search']));
            }
        } else {

            $decks = $deckRepo->findAll();
        }

        include "../templates/display.php";
    }
}
