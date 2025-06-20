<?php
    $topic = $result["data"]["topic"];
    $posts = $result["data"]["posts"];
?>
<div class="allPostsContent">
    <div class="allPosts">
    <?php if($posts)
        {
            foreach($posts as $post){?>
            <div class="message">
                <p class="auteurPost"><?= $post->getUser()->getNickName()?></p>
                <p><?= $post->getTexte() ?></p>
            </div>
        <?php } 
        }?>
    </div>
    <?php if(App\Session::getUser())
    { ?>
    <div class="addMessage">
        <form class="addMessageForm" action="index.php?ctrl=topic&action=addMessage" method="POST">
        <div class="section">
            <label for="Message" aria-label="Ajouter un message au topic"></label>
            <textarea type="text" name="texte" required="required" rows="3" cols="100" placeholder="Faites vous plaisir !"></textarea>
        </div>
            <input class="envoyer" type="submit" name="submit" value="Envoyer">
        </form>
    </div>
    <?php } ?>
    <?php if(App\Session::isAdmin())
    { ?>
    <div class="topics addCategorie">
        <a class="envoyer" href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer le topic</a>
    </div>
    <?php } ?>
</div>