<?php
    $user = $result["data"]['user']; 
    $topics = $result["data"]['topics']; 
?>

<div class="topics">
<?php foreach($topics as $topic ){ ?>
        <a href="#"><?= $topic ?><br><p> by <?= $topic->getUser() ?></p></a>
   <?php } ?>
</div>



<?php 
$titre = "Topics";
$titre_secondaire = "Liste des Topics";
?>