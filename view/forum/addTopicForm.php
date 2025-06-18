<?php 
$users = $result["data"]["users"];
?>

<div>
    <form action="index.php?ctrl=topic&action=addTopic&id=<?=$_GET['id']?>" method="post">
    <div class="section">
        <label class="labelCategorie" aria-label="Nom du topic souhaité">
            Titre du topic
        </label>
        <input type="text" class="inputForm" required="required" name="title">
    </div>
    <div class="section">
        <label class="labelCategorie" aria-label="Créateur du topic">
            Créateur du topic
        </label>
        <select type="select" class="inputForm" required="required" name="user_id">
            <?php foreach($users as $user) { ?>
                    <option value="<?= $user->getId() ?>"><?= $user ?></option>
            <?php  } ?>
        </select>
    </div>
    <div class="bouton">
        <input class="envoyer" type="submit" name="submit" value="Ajouter le topic">
    </div>
    </form>
</div>