<?php
    $categories = $result["data"]["categories"]; 
?>
<div class="topics categories">
<?php 
foreach($categories as $categorie ){ ?>
    <p><a href="index.php?ctrl=topic&action=listTopicsByCategorie&id=<?= $categorie->getId() ?>"><?= $categorie->getNomCategorie() ?></a></p>
<?php } ?>
</div>
<?php
$titre = "Liste des catégories";
$titre_secondaire = "Liste des catégories";
?>

