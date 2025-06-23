<?php
    $topic = $result["data"]["topic"];
    $posts = $result["data"]["posts"];
?>
<?php if(App\Session::isAdmin() || $topic->getUser()->getId() == $_SESSION["user"]->getId())
{ ?>
    <div class="cadenas">
        <?php if($topic->getClosed() == 0)
            { ?>
            <a href="index.php?ctrl=topic&action=closeTopic&id=<?= $topic->getId() ?>"><img class="cadenasimg" src="./public/img/deverrouillage-par-cadenas.png" alt="Image de cadena ouvert"></a>
            <?php } ?>
            <?php if($topic->getClosed() == 1)
            { ?>
                <a href="index.php?ctrl=topic&action=openTopic&id=<?= $topic->getId() ?>"><img class="cadenasimg" src="./public/img/cadenas.png" alt="Image de cadena fermé"></a>
        <?php } ?>
    </div>
<?php } ?>

<div class="allPostsContentContent">
    <div class="allPostsContent">
    <div class="allPosts">
    <?php if($posts)
        {
            foreach($posts as $post){?>
            <div class="message">
                    <div class="auteurDate">
                        <p class="auteurPost"><?= $post->getUser()->getNickName()?></p>
                        <!-- Comme l'entité post possède un id_utilisateur, on peut passer par le post pour accéder à l'utilisateur et ses information (routing) -->
                        <p class="datepost">Le <?= $post->getCreationDate() ?></p>
                    </div>
            </div>
            <div></div><p class="post"><?= $post->getTexte() ?></p>
                    <?php if(App\Session::isAdmin() || $post->getUser()->getId() == $_SESSION["user"]->getId())
                    { ?>
                        <a href="index.php?ctrl=post&action=deletePost&id=<?= $post->getId() ?>&topicId=<?=$topic->getId()?>"><img class="supr" src="./public/img/icons8-supprimer.svg" alt="Icone de poubelle"></a>
                   <?php }?>
        <?php } 
        }?>
    </div>
    <?php if($topic->getClosed() == 0)
    {
        if(App\Session::getUser())
        { ?>
        <div class="addMessage">
            <form class="addMessageForm" action="index.php?ctrl=post&action=addMessage&id=<?= $topic->getId()?>" method="POST">
            <div class="section">
                <label for="Message" aria-label="Ajouter un message au topic">Commenter :</label>
                <textarea type="text" name="texte" required="required" rows="3" cols="100"></textarea>
            </div>
                <input class="envoyer" type="submit" name="submit" value="Envoyer">
            </form>
        </div>
  <?php } ?>
<?php } ?>
    <?php if(App\Session::isAdmin())
    { ?>
    <div class="topics addCategorie">
        <a class="envoyer" href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId() ?>&idCategorie=<?= $topic->getCategorie()->getId() ?>">Supprimer le topic</a>
    </div>
    <?php } ?>
</div>
</div>
