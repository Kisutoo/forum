<div>
    <form class="formCategorie form" action="index.php?ctrl=forum&action=addCategorie" method="POST">
    <div class="section">
        <label class="labelCategorie" aria-label="Nom de la catégorie souhaité">
            Nom de la catégorie
            <br>
            (50 caractères max)
            <br>
        </label>
        <input type="text" class="inputForm" required="required" name="nomCategorie" pattern="^\s*.{0,50}\s*$">
    </div>
    <div class="bouton">
        <input class="envoyer" type="submit" name="submit" value="Ajouter la catégorie">
    </div>
    </form>
</div>

<!-- Formulaire pour ajouter une catégorie au forum -->