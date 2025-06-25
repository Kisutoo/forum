<?php
    $user = $result["data"]['user']; 
    $topics = $result["data"]['topics']; 
    $categorie = $result["data"]['categorie'];
    
?>

<!-- AFFICHAGE DES TOPICS CONTENUS DANS LA CATEGORIE -->
<div class="topics">
   <?php if($topics)
   {
     foreach($topics as $topic){ ?>
     <!-- On va afficher ici tous les topics contenus dans une catégorie -->
            <div>
                <p class="boutonCategorie">
                    <a class="lienTopic" href="index.php?ctrl=topic&action=detailTopic&id=<?=$topic->getId()?>">
                    <!-- Affichage d'un bouton qui redirige à l'interieur d'un topic -->
                        <b class="topicName"><?= $topic ?></b>
                        <!-- Nom du topic -->
                        <small class="topicCreator">by <?= $topic->getUser()->getNickName() ?></small>
                        <!-- Créateur du topic -->
                    </a>
                </p>
            </div>
    <?php } 
    }?>
</div>



<!-- AFFICHAGE DES BOUTONS -->
<div>


    <!-- BOUTON POUR AJOUTER UN TOPIC A LA CATEGORIE -->
    <?php if(App\Session::getUser())
        // Si un utilisateur est connecté au forum
        { ?>
            <div class="topics addCategorie">
                <a class="" href="index.php?ctrl=topic&action=addTopicForm&id=<?= $categorie->getId() ?>">Ajouter un topic</a>
                <!-- On lui permet d'ajouter un topic dans la catégorie dans laquelle on se trouve -->
            </div>
    <?php } ?>


    <!-- BOUTON POUR SUPPRIMER LA CATEGORIE DANS LAQUELLE ON SE TROUVE -->
    <?php if(App\Session::isAdmin())
        // Si l'utilisateur connecté est un admin
        { ?>
            <div class="topics addCategorie">
                <a class="" href="index.php?ctrl=forum&action=deleteCategorie&id=<?= $categorie->getId() ?>">Supprimer la catégorie</a>
                <!-- On met à sa disposition un bouton lui permettant de supprimer une catégorie entière, dont les topics se trouvant en son sein -->
            </div>
    <?php } ?>


</div>