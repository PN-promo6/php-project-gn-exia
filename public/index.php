<?php

namespace Entity;

use Entity\User;
use Entity\Deck;
use ludk\Persistence\ORM;

require __DIR__ . '/../vendor/autoload.php';
$orm = new ORM(__DIR__ . '/../Resources');
$codeRepo = $orm->getRepository(Deck::class);
$decks = array();
if (isset($_GET['search'])) {
  $decks = $codeRepo->findBy(array("content" => $_GET['search']));
} else {
  $decks = $codeRepo->findAll();
}

// require '../vendor/autoload.php';

// $usr1 = new User();
// $usr1->id = 1;
// $usr1->nickname = "Toshikikai";
// $usr1->password = "StandUpTheVanguard";

// $deck1 = new Deck();
// $deck1->id = 1;
// $deck1->deckName = "Dragonic Overlord - The Purge";
// $deck1->clan = "Kagero";
// $deck1->img = "https://vignette.wikia.nocookie.net/cardfight/images/2/22/Supreme_Heavenly_Emperor_Dragon%2C_Dragonic_Overlord_The_Purge_%28Full_Art%29.png/revision/latest?cb=20181229111356";
// $deck1->description = "Flames of the apocalypse will rise again!";

// $usr2 = new User();
// $usr2->id = 2;
// $usr2->nickname = "Toshikikai";
// $usr2->password = "StandUpTheVanguard";

// $deck2 = new Deck();
// $deck2->id = 2;
// $deck2->deckName = "Marshal General of Surging Seas, Alexandros";
// $deck2->clan = "Aqua Force";
// $deck2->img = "https://vignette.wikia.nocookie.net/cardfight/images/7/7f/Marshal_General_of_Wave_Honor%2C_Alexandros_%28Full_Art%29.png/revision/latest?cb=20171117102230";
// $deck2->description = "Overcomming time itself. Alliance Army is here!";

// $usr3 = new User();
// $usr3->id = 3;
// $usr3->nickname = "Toshikikai";
// $usr3->password = "StandUpTheVanguard";

// $deck3 = new Deck();
// $deck3->id = 3;
// $deck3->deckName = "Dragonic Kaiser Vermillion";
// $deck3->clan = "Narukami";
// $deck3->img = "https://vignette.wikia.nocookie.net/cardfight/images/1/13/Dragonic_Kaiser_Vermillion_%28Full_Art-V%29.png/revision/latest?cb=20181214031536";
// $deck3->description = "This is the power to break through all limits!";

//$decks = array($deck1, $deck2, $deck3);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Publish your best deck</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/style.css?time=<?php echo time(); ?>" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Meta Gang</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <!-- /.col-lg-3 -->

    <div class="row">

      <?php
      $i = 0;
      foreach ($decks as $deck) {
        if ($i % 3 == 0 && $i > 0) {
          echo '</div><div class="row">';
        }

      ?>
        <div class="col-4">
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="<?php echo $deck->img; ?>" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="#"><?php echo $deck->deckName; ?></a>
              </h4>

              <p class="card-text"><?php echo $deck->description; ?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>
      <?php
        $i++;
      }
      ?>
    </div>

    <!-- /.row -->

    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-primary">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>