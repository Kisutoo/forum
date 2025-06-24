<?php
    $categories = $result["data"]["categories"]; 
?>
<?php if(App\Session::isAdmin())
// Si l'utilisateur connecté au forum est un admin
{ ?>
<div class="topics addCategorie">
    <a class="" href="index.php?ctrl=forum&action=addCategorieForm">Ajouter une catégorie</a>
    <!-- On affiche un bouton qui nous redirige vers une page permettant l'insersion d'une nouvelle catégorie dans le forum -->
</div>
<?php } ?>
<div class="topics categories">
<?php 
foreach($categories as $categorie ){ ?>
<!-- Affichage des catégories -->
    <p><a href="index.php?ctrl=topic&action=listTopicsByCategorie&id=<?= $categorie->getId() ?>"><?= $categorie->getNomCategorie() ?></a></p>
    <!-- On affiche des boutons contenant le nom d'une catégories et leur Id correspondant (invisible) -->
<?php } ?>
</div>


