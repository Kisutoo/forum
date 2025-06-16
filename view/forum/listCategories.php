<?php
    $categories = $result["data"]["categories"]; 
?>
<?php 
foreach($categories as $categorie ){ ?>
    <p><a href="index.php?ctrl=forum&action=listTopicsByCategorie&id=<?= $categorie->getId() ?>"><?= $categorie->getNomCategorie() ?></a></p>
<?php } ?>

<?php
$titre = "Liste des catégories";
$titre_secondaire = "Liste des catégories";
?>

