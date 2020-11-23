<?php
session_start();
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

    <form action="connexion.php" method="get" class="moduleform">
        <fieldset class="formfieldset">

            <?php

            $signal=0;
            if(!isset($_SESSION['login']))
            echo "<div class='form-group'>
                <label for='exampleInputEmail1'>Login</label>
                <input type='text' class='form-control' id='login' name='login' aria-describedby='emailHelp' required>
            </div>
            <div class='form-group'>
                <label for='exampleInputPassword1'>Password</label>
                <input type='password' class='form-control' id='password' name='password' required>
            </div>
            <input type='submit' class='btn btn-primary btn2' name='submit'value='Submit'>";
            $db=mysqli_connect('localhost','root','','livreor');
            $req="SELECT * FROM `utilisateurs`";
            $query=mysqli_query($db,$req);
            $all_results=mysqli_fetch_all($query);

            foreach($_GET as $key=>$value){
                if($key=="login"){
                    $login=$value;
                }
                if($key=="password"){
                    $password=$value;
                }
            }
            if(isset($_GET['submit'])){
                for($i=0;isset($all_results[$i]);$i++){
                    if($all_results[$i][1]==$login && $all_results[$i][2]==$password){
                        $_SESSION['id']=$all_results[$i][0];
                        $_SESSION['login']=$login;
                        $_SESSION['password']=$password;
                        header("Location:connexion.php");
                        $signal=1;
                    }
                }
                if (!isset($_SESSION['login']) && isset($login)){
                    echo "Rentrez des informations corrects";
                }
            }
            if(isset($_SESSION['login'])){
                echo "<input type='submit' class='btn btn-primary btn2' name='profil' value='Profil'>";
                echo "<input type='submit' class='btn btn-primary btn2' name='commentaire' value='Lache un comm'>";
                if(isset($_GET['profil'])){
                    header("Location:profil.php");
                }
                if(isset($_GET['commentaire'])){
                    header("Location:commentaire.php");
                }

            }

            ?>
        </fieldset>
    </form>
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