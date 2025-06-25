<?php
    $user = $result["data"]['user']; 
    $topics = $result["data"]['topics']; 
?>

<div class="topics">
   <?php if($topics)
   {
     foreach($topics as $topic)
      { ?>
     <!-- On va afficher ici tous les topics contenus dans une catégorie -->
            <div>
                <a class="lienTopic" href="index.php?ctrl=topic&action=detailTopic&id=<?=$topic->getId()?>">
                <!-- Affichage d'un bouton qui redirige à l'interieur d'un topic -->
                    <b class="topicName"><?= $topic ?></b>
                    <!-- Nom du topic -->
                    <small class="topicCreator">by <?= $topic->getUser()->getNickName() ?></small>
                    <!-- Créateur du topic -->
                </a>
            </div>
<?php } 
    }?>
</div>