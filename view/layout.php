<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kavivanar&display=swap" rel="stylesheet">
    <meta name="description" content="<?= $meta_description ?>">
    <title><?=$titre?></title>
</head>
<body>
    <header>
        <nav>
            <div>
                <a class="accueil" href="index.php">Accueil</a>
              <?php if(App\Session::isAdmin())
              // Si l'utilisateur connecté possède le role administrateur
              { ?>
                <a href="index.php?ctrl=admin&action=adminPage">Admin</a>
                <!-- Lien vers un Pannel Administrateur ou l'on peut modérer les utilisateurs -->
            <?php  } ?>
            </div>
            <?php if(App\Session::isAdmin())
            // Si l'utilisateur à la role admin, on appelle directement la fonction en passant par le fichier ou elle se trouve
            { ?>
                <a href="index.php?ctrl=topic&action=listTopics">ListTopics</a>
            <?php } // Seul les admins voient ce lien ?>
            <a href="index.php?ctrl=forum&action=listCategories">listCategories</a>
            <div>
         <?php if(App\Session::getUser())
         // Si le tableau de SESSION n'est pas vide, donc si un utilisateur est connecté au forum
               { ?>
                <div class="navincription">
                    <a href="index.php?ctrl=security&action=profilePage&id=<?= $_SESSION["user"] ?>">Mon profil</a>
                    <a href="index.php?ctrl=security&action=logout">Se déconnecter</a> 
                    <!-- Affichage des boutons Mon profil et Se déconnecter de la barre de navigation -->
               </div>
         <?php } 
                else
                // Si personne n'est connecté au forum
                { ?>
                <div class="navincription">
                    <a href="index.php?ctrl=security&action=loginPage">Se connecter</a>
                    <a href="index.php?ctrl=security&action=registerPage">S'inscrire</a>
                    <!-- Affichage des boutons se connecter et s'inscrire de la barre de navigation -->
                </div>
         <?php  } ?>

            </div>
        </nav>
    </header>
    <main>
        <h3 class="infomessage" style="color: red"><?= App\Session::getFlash("error") ?></h3>
        <h3 class="infomessage" style="color: green"><?= App\Session::getFlash("success") ?></h3>
        <h1><?= $titre_secondaire ?></h1>
        <?= $page // Réceptionne les messages que l'on veut faire passer à l'utilisateur,  que l'on ajoutera via la fonction addFlash ?>
    </main>
    <footer>

    </footer>
    
</body>
</html>