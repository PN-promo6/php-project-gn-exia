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
                        <a class="nav-link" href="?">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php
                    if (isset($_SESSION['user'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/new" role="button">add</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/logout" role="button">Logout</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login" role="button">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register" role="button">Sign Up</a>
                        </li>
                    <?php
                    }
                    ?>
                    <li>
                        <form action="">
                            <input type="text" name="search" placeholder="Search">
                        </form>
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
                            <a href="search?search=%23<?= $deck->clan->id ?>">
                                #<?= $deck->clan->clanName ?></a>
                        </div>
                        <div class="card-footer">
                            <a href="search?search=@<?= $deck->user->nickname ?>">
                                @<?= $deck->user->nickname ?></a>
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
            <p class="m-0 text-center text-white">Copyright &copy; MetaGang 2020 </p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>