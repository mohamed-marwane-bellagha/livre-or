<?php
session_start()
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon Livre d'or</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="moduleconnexion.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Mon Livre d'or</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <?php
                if(!isset($_SESSION['login'])){
                    echo "<li class='nav-item'><a class='nav-link' href='inscription.php'>Inscription</a></li>";
                    echo  "<li class='nav-item'>";
                    echo "<a class='nav-link' href='connexion.php'>Connexion</a></li>";
                }else{
                    echo "<li class='nav-item'><form action='connexion.php' method='get'><input class='btn btn-link' type='submit' name='disconnect' value='Déconnexion'></form></li>";
                    if(isset($_GET['disconnect'])){
                        unset($_SESSION['login']);
                        session_destroy();
                        header('Location:connexion.php');
                    }
                    echo "<a class='nav-link' href='commentaire.php'>Lache un comm</a></li>";
                }
                ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="livre-or.php">Livre d'or</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">A propos</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main>
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./images/slide1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Un livre d'or</h5>
                    <p>Pour des pessonnes en or</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./images/slide2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Avec des commentaires en or</h5>
                    <p>Par des personnes en or</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./images/slide3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Et des visiteurs en or</h5>
                    <p>Avec un caractere en or</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</main>
<footer>
    <ul class="list-group">
        <li class="list-group-item middle"><a href="index.php">Accueil</a></li>

        <?php
        if(!isset($_SESSION['login'])){
            echo "<li class='list-group-item middle'><a href='connexion.php'>Connexion</a></li><li class='list-group-item middle'><a href='inscription.php'>Inscrivez-vous</a></li>";

        }else{
            echo "<li class='list-group-item middle paddng'><form action='index.php' method='get'><input class='btn btn-link'  type='submit' name='disconnect' value='Déconnexion'></form></li>";
            if(isset($_GET['disconnect'])){
                unset($_SESSION['login']);
                session_destroy();
                header('Location:index.php');
            }
        }       ?>
        <li class="list-group-item middle"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">A propos</a>   </li>
    </ul>

</footer>



</body>
</html>