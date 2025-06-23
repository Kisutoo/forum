<div class="contentForm">
    <form class="form" action="index.php?ctrl=security&action=login" method="POST">
        <div class="section">
            <label for="mail" aria-label="Adresse mail">Mail</label>
            <input class="inputForm" type="text" required="required" name="mail" placeholder="exemple@hotmail.com">
        </div>

        <div class="section">
            <label for="password" aria-label="Mot de passe">Mot de passe</label>
            <input class="inputForm" type="text" required="required" name="password" placeholder="*********">
        </div>

        <input class="envoyer" type="submit" name="submit" value="Se connecter">
    </form>
</div>