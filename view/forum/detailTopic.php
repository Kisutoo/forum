<?php
    $topic = $result["data"]["topic"];
    $posts = $result["data"]["posts"];
?>
<div class="allPosts">
<?php foreach($posts as $post){?>
    <div class="message">
        <p><?= $post->getUser()->getNickName()?></p>
        <p><?= $post->getTexte() ?></p>
    </div>
<div class="topics addCategorie">
    <a class="" href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer le topic</a>
</div>
<?php } ?>
</div>
