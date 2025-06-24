<?php
$users = $result["data"]["users"];
?>

<div class="profil">



</div>
<div class="topics addCategorie">
    <a class="envoyer" href="index.php?ctrl=security&action=deleteProfile&id=<?= $users ?>">Supprimer le profile</a>
        <!-- On affiche un bouton qui redirige vers une fonction pour supprimer le profil dans sa globalité -->
</div>