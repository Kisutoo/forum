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

<?php 
$titre = $categorie->getNomCategorie();
$titre_secondaire = $categorie->getNomCategorie();
?>