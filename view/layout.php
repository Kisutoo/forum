<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kavivanar&display=swap" rel="stylesheet">
    <title><?=$titre?></title>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?ctrl=forum&action=listTopics">ListTopics</a>
            <a href="index.php?ctrl=forum&action=listCategories">listCategories</a>
            <div>
                <a href="index.php?ctrl=security&action=login">Se connecter</a>
                <a href="index.php?ctrl=security&action=register">S'inscrire</a>
            </div>
        </nav>
    </header>
    <main>
        <h1><?= $titre_secondaire ?></h1>
        <?= $page ?>
    </main>
    
</body>
</html>