<?php

namespace Controller;

use Entity\Clan;
use Entity\Deck;
use Entity\User;
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

        $userRepo = $this->getOrm()->getRepository(User::class);
        $deckRepo = $this->getOrm()->getRepository(Deck::class);
        $clanRepo = $this->getOrm()->getRepository(Clan::class);
        $manager = $this->getOrm()->getManager();

        $decks = array();

        if ($request->query->has('search')) {

            $search = $request->query->get('search');

            if (strpos($search, "@") === 0) {

                $nickname = substr($search, 1);

                $users = $userRepo->findBy(["nickname" => $nickname]);

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

        return $this->render('display.php', ['decks' => $decks]);
    }
}
