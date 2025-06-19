<div class="contentForm">
    <form class="registerForm" action="index.php?ctrl=security&action=register" method="POST">
        <label for="pseudo" aria-label="Pseudo">Pseudo</label>
        <input class="inputForm" type="text" required="required" name="pseudo">
        
        
        <label for="mail" aria-label="Adresse Email">Mail</label>
        <input class="inputForm" type="text" required="required" name="mail">

        <label for="password" aria-label="Mot de passe">Mot de passe</label>
        <input class="inputForm" type="text" required="required" name="password1">

        <label for="passwordConfirm" aria-label="Adresse Email">Confirmation du mot de passe</label>
        <input class="inputForm" type="text" required="required" name="password2">

        <input type="submit" value="S'inscrire">
    </form>
</div>