<?php

namespace Entity;

use Entity\Clan;

use Entity\Deck;

use Entity\User;

use ludk\Persistence\ORM;
use Controller\AuthController;
use Controller\HomeController;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$orm = new ORM(__DIR__ . '/../Resources');

$userRepo = $orm->getRepository(User::class);

$deckRepo = $orm->getRepository(Deck::class);

$clanRepo = $orm->getRepository(Clan::class);

$manager = $orm->getManager();

$action = substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 1);

switch ($action) {

  case 'register':

    $controller = new AuthController();
    $controller->register();

    break;

  case 'logout':
    $controller = new AuthController();
    $controller->logout();
    break;

  case 'login':
    $controller = new AuthController();
    $controller->login();
    break;

  case 'new':

    break;
  default;
  case 'display':
    $controller = new HomeController();
    $controller->display();
    break;
}
