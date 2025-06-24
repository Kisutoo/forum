<?php 
$users = $result["data"]["users"];
?>

<div>
    <form class="form formCategorie" action="index.php?ctrl=topic&action=addTopic&id=<?=$_GET['id']?>" method="post">
    <div class="section">
        <label class="labelCategorie" aria-label="Nom du topic souhaité">
            Titre du topic<br>
            <small><i>(50 caractères max)</i><small>
        </label>
        <input type="text" class="inputForm" required="required" name="title" pattern="^\s*.{0,50}\s*$">
    </div>
    <div class="bouton">
        <input class="envoyer" type="submit" name="submit" value="Ajouter le topic">
    </div>
    </form>
</div>

<!-- Formulaire pour ajouter un topic à une catégorie -->