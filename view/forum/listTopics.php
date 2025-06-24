<?php
    $user = $result["data"]['user']; 
    $topics = $result["data"]['topics']; 
?>

<div class="topics">
<?php foreach($topics as $topic ){ ?>
    <!-- On va afficher ici tous les topics créés indépendamment des catégories auquel ils appartiennent -->
    <a href="index.php?ctrl=topic&action=detailTopic&id=<?=$topic->getId()?>"><?= $topic ?><br><p> by <?= $topic->getUser()->getNickName() ?></p></a>
    <!-- On affiche un bouton qui redirige à l'intérieur du topic, ce bouton contient l'id du topic (invisible), le nom de celui-ci et son créateur -->
   <?php } ?>
</div>