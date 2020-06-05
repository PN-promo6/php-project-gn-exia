<?php

namespace Controller;

use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function display(Request $request): Response
    {
        global $userRepo;
        global $deckRepo;
        global $clanRepo;

        $userRepo = $this->getOrm()->getRepository(Language::class);
        $deckRepo = $this->getOrm()->getRepository(Language::class);
        $clanRepo = $this->getOrm()->getRepository(Language::class);
        $manager = $this->getOrm()->getManager();

        $decks = array();

        if ($request->query->has('search')) {

            $search = $request->query->get('search');

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

                $decks = $deckRepo->findBy(array("description" => $search));
            }
        } else {

            $decks = $deckRepo->findAll();
        }

        include "../templates/display.php";
    }
}
