<?php
    $user = $result["data"]['user']; 
    $topics = $result["data"]['topics']; 
    $categorie = $result["data"]['categorie'];
    
?>

<div class="topics">

<?php foreach($topics as $topic ){ ?>
        <a href="index.php?ctrl=topic&action=detailTopic&id=<?=$topic->getId()?>"><?= $topic ?><br><p> by <?= $topic->getUser() ?></p></a>
<?php } ?>

</div>
<div class="topics addCategorie">
    <a class="" href="index.php?ctrl=topic&action=addTopicForm&id=<?= $categorie->getId() ?>">Ajouter un topic</a>
</div>
<div class="topics addCategorie">
    <a class="" href="index.php?ctrl=forum&action=deleteCategorie&id=<?= $categorie->getId() ?>">Supprimer la catégorie</a>
</div>