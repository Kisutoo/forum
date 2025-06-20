<?php
    $categories = $result["data"]["categories"]; 
?>
<?php if(App\Session::isAdmin())
{ ?>
<div class="topics addCategorie">
    <a class="" href="index.php?ctrl=forum&action=addCategorieForm">Ajouter une catégorie</a>
</div>
<?php } ?>
<div class="topics categories">
<?php 
foreach($categories as $categorie ){ ?>
    <p><a href="index.php?ctrl=topic&action=listTopicsByCategorie&id=<?= $categorie->getId() ?>"><?= $categorie->getNomCategorie() ?></a></p>
<?php } ?>
</div>


