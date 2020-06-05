<?php

namespace Entity;

use Entity\User;

use Entity\Deck;

use Entity\Clan;

use ludk\Persistence\ORM;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$orm = new ORM(__DIR__ . '/../Resources');

$userRepo = $orm->getRepository(User::class);

$deckRepo = $orm->getRepository(Deck::class);

$clanRepo = $orm->getRepository(Clan::class);

$manager = $orm->getManager();

$action = $_GET["action"] ?? "display";

switch ($action) {

  case 'register':

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordRetype'])) {

      $errorMsg = NULL;

      $users = $userRepo->findBy(array("nickname" => $nickname));

      if (count($users > 0)) {

        $errorMsg = "Nickname already used.";
      } else if ($_POST['password'] != $_POST['passwordRetype']) {

        $errorMsg = "Passwords are not the same.";
      } else if (strlen(trim($_POST['password'])) < 8) {

        $errorMsg = "Your password should have at least 8 characters.";
      } else if (strlen(trim($_POST['username'])) < 4) {

        $errorMsg = "Your nickame should have at least 4 characters.";
      }

      if ($errorMsg) {

        include "../templates/registerform.php";
      } else {

        $user = new User;

        $user->nickname = $_POST['nickname'];

        $user->password = $_POST['password'];

        $_SESSION['user'] = $user;

        $manager->persist($user);

        $manager->flush();

        header('Location: ?action=register');
      }
    } else {

      include "../templates/registerform.php";
    }

    break;

  case 'logout':

    if (isset($_SESSION['user'])) {

      unset($_SESSION['user']);
    }
    header('Location: ?action=display');

    break;

  case 'login':

    if (isset($_POST['username']) && isset($_POST['password'])) {

      $users = $userRepo->findBy(array("nickname" => $_POST['username']));

      if (count($users) == 1) {

        $user = $users[0];

        if ($user->password != md5($_POST['password'])) {

          $errorMsg = "Wrong password.";

          include "../templates/loginform.php";
        } else {

          $_SESSION['user'] = $users[0];

          header('Location:/?action=display');
        }
      } else {

        $errorMsg = "Nickname doesn't exist.";

        include "../templates/loginform.php";
      }
    } else {

      include "../templates/loginform.php";
    }
    break;

  case 'new':
    if (!isset($_SESSION['user'])) {
      header('Location:/?action=display');
    } else {
      $clans = $clanRepo->findAll();
      var_dump($clans);
      if (
        isset($_POST['clan']) && isset($_POST['deckName'])
        && isset($_POST['description']) && isset($_POST['image'])
      ) {
        $errorMsg = NULL;
        if ($_POST['deckName'] == "0") {
          $errorMsg = "Name your deck.";
        } else if (empty($_POST['clan'])) {
          $errorMsg = "Choose a clan.";
        } else if (empty($_POST['description'])) {
          $errorMsg = "Put a description.";
        } else if (empty($_POST['content'])) {
          $errorMsg = "Put an image.";
        }
        if ($errorMsg) {
          include "../templates/new.php";
        } else {
          $clan = $clanRepo->find($_POST['clan']);
          $newdeck = new Deck();
          $newdeck->deckName = $_POST['deckName'];
          $newdeck->description = $_POST['description'];
          $newdeck->content = $_POST['content'];
          $newdeck->creationDate = time();
          $newdeck->deck = $deck;
          $newdeck->user = $_SESSION['user'];
          $manager->persist($newDeck);
          $manager->flush();
          header('Location:/?action=display');
        }
      } else {
        include "../templates/new.php";
      }
    }
    break;

  case 'display':

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

  default;

    break;
}
