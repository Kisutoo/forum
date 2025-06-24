<div class="contentForm">
    <form class="formregister form" action="index.php?ctrl=security&action=register" method="POST">
        <div class="section">
            <label for="pseudo" aria-label="Pseudo">Pseudo</label>
            <input class="inputForm" type="text" required="required" name="pseudo" placeholder="exemple">
        </div>

        <div class="section">
            <label for="mail" aria-label="Adresse Email">Mail</label>
            <input class="inputForm" type="text" required="required" name="mail" placeholder="exemple@hotmail.com">
        </div>
        
        <div class="section">
            <label for="password" aria-label="Mot de passe"><p>Mot de passe</p><p>(8 caractères minimum, 1 numéro, 1 majuscule, 1 minuscule, 1 caractère spécial)<br></label>
            <input class="inputForm" type="password" required="required" name="password1" placeholder="********">
        </div>
        
        <div class="section">
            <label for="passwordConfirm" aria-label="Adresse Email">Confirmation du mot de passe</label>
            <input class="inputForm" type="password" required="required" name="password2" placeholder="********">
        </div>
        
        <input class="envoyer" type="submit" name="submit" value="S'inscrire">
    </form>
</div>

<!-- Formulaire pour pouvoir s'inscrire au forum -->