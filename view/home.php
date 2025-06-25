<h3 class="pseudohome"><?php 
if(isset($_SESSION["user"])){
    echo  $_SESSION["user"]->getNickName() ." !</h3>";
}
?>