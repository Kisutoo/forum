<?php
    $user = $result["data"]['user']; 
    $topics = $result["data"]['topics']; 
?>

<div class="topics">
<?php
    $i = 0;
    foreach($topics as $topic ){ ?>
        <a href="#" class="l<?= $i ?>"><?= $topic ?><br><p> by <?= $topic->getUser() ?></p></a>
   <?php $i++; 
    } ?>
</div>



<?php 
$titre = "Topics";
$titre_secondaire = "Liste des Topics";
?>