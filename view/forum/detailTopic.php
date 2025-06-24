<?php
    $topic = $result["data"]["topic"];
    $posts = $result["data"]["posts"];
?>

<?php if(isset($_SESSION["user"]))
{
    if(App\Session::isAdmin() || $topic->getUser()->getId() == $_SESSION["user"]->getId())
    // Si l'utilisateur connecté est un admin ou si c'est l'auteur du topic
    { ?>
        <div class="cadenas">
            <?php if($topic->getClosed() == 0)
            // On vérifie le topic est fermé ou non grace à la colonne "closed" de la base de donnée, getClosed nous permet de récupérer cette valeur, 0 pour ouvert et 1 pour fermé
                { ?>
                <a href="index.php?ctrl=topic&action=closeTopic&id=<?= $topic->getId() ?>"><img class="cadenasimg" src="./public/img/deverrouillage-par-cadenas.png" alt="Image de cadena ouvert"></a>
                <!-- Si le topic est ouvert, on affiche un bouton qui redirige vers une fonction pour le clore le topic, seul un administrateur ou l'auteur de celui-ci y ont accès -->
                <?php } ?>
                <?php if($topic->getClosed() == 1)
                // Si le topic est considéré comme étant fermé
                { ?>
                    <a href="index.php?ctrl=topic&action=openTopic&id=<?= $topic->getId() ?>"><img class="cadenasimg" src="./public/img/cadenas.png" alt="Image de cadena fermé"></a>
                    <!-- On affiche un bouton qui redirige vers une fonction permettant d'ouvert le topic et d'autoriser à nouveau la saisie de messages -->
          <?php } ?>
        </div>
    <?php } ?>
<?php } ?>

<div class="allPostsContentContent">
    <div class="allPostsContent">
    <div class="allPosts">
    <?php if($posts)
        {
            foreach($posts as $post){?>
            <div class="message">
                    <div class="auteurDate">
                        <p class="auteurPost">
                  <?php if(!$post->getUser())
                        {
                            echo "Utilisateur Anonyme";
                        }
                        else
                        {
                          echo $post->getUser()->getNickName();
                        } ?>
                        </p>
                        <!-- Comme l'entité post possède un id_utilisateur, on peut passer par le post pour accéder à l'utilisateur et ses information (routing) -->
                        <p class="datepost">Le <?= $post->getCreationDate() ?></p>
                        <!-- Ici on récupère la date de création du message -->
                    </div>
            </div>
            <div class="messagetxt">
                <p class="post"><?= $post->getTexte() ?></p>
                <!-- On affiche le contenu du message -->
                    <div class="actionAdmin"><?php if(isset($_SESSION["user"]))
                    // Si quelqu'un est connecté au site sur le navigateur, donc si le tableau de _SESSION["user"] n'est pas vide
                    {  
                        if(App\Session::isAdmin() || $post->getUser() == $_SESSION["user"])
                        // Si la personne connectée est un admin, ou si c'est l'auteure du message
                        { ?>
                            <a href="index.php?ctrl=post&action=deletePost&id=<?= $post->getId() ?>&topicId=<?=$topic->getId()?>"><img class="supr" src="./public/img/icons8-supprimer.svg" alt="Icone de poubelle"></a>
                            <!-- On affiche un bouton de redirection vers une fonction qui permet la suppression du message dans le cas ou la personne connectée est l'auteure ou un admin -->
                    <?php }
                        if($post->getUser() != $_SESSION["user"])
                        // Si l'auteur du message n'est pas la personne connectée au forum
                        { ?>
                            <a href="index.php?ctrl=admin&action=warnMessage&id=<?= $post->getId() ?>&topicId=<?= $topic->getId() ?>"><img class="pointdex"src="./public/img/point-dexclamation.png" alt="Point d'exclamation"></a>
                            <!-- Affichage d'un bouton de signalement, je n'ai pas autorisé l'auteur à signaler son propre message pour éviter les abus, l'auteure peut toujours supprimer son message s'il ne lui convient plus -->
                  <?php } ?>
                <?php } ?></div>
                    
            </div>
        <?php } 
        }?>
    </div>
    <?php if($topic->getClosed() == 0)
    // On s'assure que le topic est ouvert, si c'est le cas
    {
        if(App\Session::getUser())
        // Si un utilisateur est connecté au forum, on affiche un formulaire pour ajouter un post au topic
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
    // Si l'utilisateur connecté au forum est un admin
    { ?>
    <div class="topics addCategorie">
        <a class="envoyer" href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId() ?>&idCategorie=<?= $topic->getCategorie()->getId() ?>">Supprimer le topic</a>
        <!-- On affiche un bouton qui redirige vers une fonction pour supprimer le topic dans sa globalité -->
    </div>
    <?php } ?>
</div>
</div>
