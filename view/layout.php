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
            <a href="index.php">Accueil</a>
            <a href="index.php?ctrl=topic&action=listTopics">ListTopics</a>
            <a href="index.php?ctrl=forum&action=listCategories">listCategories</a>
            <div>
         <?php if(isset($_SESSION["user"]))
               { ?>
                    <a href="index.php?ctrl=security&action=profile">Mon profil</a>
                    <a href="index.php?ctrl=security&action=logout">Se déconnecter</a> 
         <?php } 
                else
                { ?>
                    <a href="index.php?ctrl=security&action=loginPage">Se connecter</a>
                    <a href="index.php?ctrl=security&action=registerPage">S'inscrire</a> 
         <?php  } ?>

            </div>
        </nav>
    </header>
    <main>
        <h1><?= $titre_secondaire ?></h1>
        <?php if(isset($_SESSION["error"]))
        { ?>
            <h2><?= $_SESSION["error"] ?></h2>
            <?php unset($_SESSION["error"]);
        } ?>
        <?= $page ?>
    </main>
    <footer>

    </footer>
    
</body>
</html>