<?php
    $topic = $result["data"]["topic"];
    $posts = $result["data"]["posts"];
?>
<div class="allPosts">
<?php if($posts)
    {
        foreach($posts as $post){?>
        <div class="message">
            <p><?= $post->getUser()->getNickName()?></p>
            <p><?= $post->getTexte() ?></p>
        </div>
    <?php } 
    }?>
</div>
<div class="topics addCategorie">
    <a class="" href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer le topic</a>
</div>