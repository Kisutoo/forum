<?php
$warns = $result["data"]["warns"];
$users = $result["data"]["users"];
$users1 = $result["data"]["listUsers"];

if(App\Session::isAdmin())
{ ?>
    <div class="adminSection1">
        <div class="listWarnedMessages">
            <h3>Messages signalés :</h3>
            <?php foreach($warns as $warn)
            // Affichage de tous les messages qui ont été signalés
            { ?>
            <div class="warnedMessage">
                <p><b><?php if($warn->getUser())
                // Si l'Id utilisateur du message signalé existe (donc n'est pas égal à NULL)
                {
                    echo $warn->getUser()->getNickName(); 
                    // On affiche le pseudo de l'utilisateur du message signalé à coté de celui ci
                }
                else
                // Sinon on affiche Utilisateur anonyme
                {
                    echo "Utilisateur Anonyme";
                } ?> : </b><?= $warn ?></p>
                <!-- On récupère le pseudo de l'utilisateur et le message signalé -->
                <a href="index.php?ctrl=admin&action=adminDeletePost&id=<?= $warn->getPost()->getId() ?>&topicId=<?=$warn->getPost()->getTopic()->getId()?>"><img class="supr" src="./public/img/icons8-supprimer.svg" alt="Icone de poubelle"></a>
                <!-- lien vers la fonction de suppression du message (va supprimer le message du topic ou il se trouve) -->
                <?php if($warn->getUser())
                // Si on arrive a récupérer un id utilisateur avec le message signalé, on affiche un bouton pour bannir l'utilisateur, on ne l'affiche pas si le message signalé ne possède plus d'utilisateur car on ne peut pas bannir un utilisateur qui n'existe pas
                { ?>
                    <a href="index.php?ctrl=admin&action=banUser&id=<?= $warn ?>"><img class="supr" src="./public/img/interdiction.png" alt="Icone d'interdiction"></a>
                <?php } ?>
                <!-- lien vers la une fonction qui va changer l'état de l'utilisateur et le bannir (l'empêcher de se connecter au forum) -->
            </div>
            <?php } ?>
        </div>
        <div class="listeUtilisateursBannis">
            <h3>Utilisateurs bannis :</h3>
        <div class="listBannedUsers">
               <?php foreach($users as $user)
               // Affiche de tous les utilisateurs qui ont été bannis
               { ?>
                <div class="bannedUsers">
                    <?php if($user->getIsBanned() === 1)
                    // Il y a en base de donnée, une colonne isBanned avec un boolean, 0 de base et 1 si l'utilisateur est banni, "getIsBanned()" récupère cette colonne et si sa valeur est de 1 (banni)
                    // on affiche cet utilisateur
                    { ?>
                        <p><?= $user->getNickName() ?></p>
                        <!-- Affichage de l'utilisateur banni -->
                        <a href="index.php?ctrl=admin&action=unbanUser&id=<?= $user->getId() ?>"><img class="supr" src="./public/img/fermer.png" alt="icone de croix"></a>
                        <!-- Bouton de redirection vers une fonction qui permet de changer l'état de l'utilisateur et de le déban (donc de lui permettre de se connecter) -->
                    <?php } ?>
                </div>
            <?php } ?> 
        </div>
        </div>
        
    </div>
    <div class="adminSection1">
        <div>
            <h3>Liste des utilisateurs :</h3>
        <a href=""></a>
        <div class="listUsers">
        <?php foreach($users1 as $user)
        // On va récupérer ici tous les utilisateurs du site
        { ?>
            <div class="user">
                <p><?= $user->getNickName() ?></p>
                <!-- Affichage de l'utilisateur -->
                <?php if($user->getIsBanned() === 0)
                // Si l'utilisateur n'est pas banni, on affiche un bouton qui va nous permettre de le ban et de l'empêcher de se connecter
                { ?>
                    <a href="index.php?ctrl=admin&action=banUser&id=<?= $user->getId() ?>"><img class="supr" src="./public/img/interdiction.png" alt="Icone d'interdiction"></a>
                <?php }
                else
                { ?>
                    <p>(banned)</p>
                    <!-- Si il est déjà banni, on affiche qu'il a été banni -->
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    </div>
</div>
        
    
<?php } ?>