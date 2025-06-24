<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;
use Model\Managers\PostManager;
use Model\Managers\WarnManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
    // Redirection vers la page d'accueil
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum"
        ];
    }

    public function listCategories() {
        // créer une nouvelle instance de CategorieManager
        $categorieManager = new CategorieManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categorieManager->findAll(["nomCategorie", "ASC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "titre" => "Liste des catégories",
            "titre_secondaire" => "Liste des catégories",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function addCategorieForm() {
    // Redirection vers le formulaire pour ajouter une catégorie au forum
        return [
            "view" => VIEW_DIR . "forum/addCategorieForm.php",
            "meta_description" => "Page pour ajouter une catégorie au forum",
            "titre" => "Ajouter une catégorie",
            "titre_secondaire" => "Ajouter une catégorie",
        ];
    }

    public function addCategorie() {
    // Fontion permettant d'ajouter une catégorie au forum
        
        $session = new Session();

        if(isset($_POST['submit']))
        {
            $nomCategorie = filter_input(INPUT_POST, "nomCategorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // On assainit les champs rentrés, en l'occurence, le nom de la catégorie

            $categorieManager = new CategorieManager();
            if($nomCategorie)
            // Si la variable existe après avoir été assainie
            {
                $categorieArray = array ("nomCategorie" => $nomCategorie);
                // On créé un tableau qui associe le nom de la catégorie souhaité à la colonne nomCatégorie de la base de donnée

                $categorieManager->add($categorieArray);
                // On ajoute cette ligne en base de donnée grace à add()

                $session->addFlash("success", "La catégorie a bien été ajoutée !");
                $this->redirectTo("forum", "listCategories"); exit;
                // Puis on redirige l'utilisateur vers la liste des catégories
            }
            else
            // Si la variable n'a pas pu être déclarée après avoir été assainie
                $this->redirectTo("forum", "addCategorieForm");
                // On redirige l'utilisateur vers le formulaire d'ajout de catégories
        }
        else
        // Si quelqu'un accès à cette fonction sans avoir rien rentré dans le formulaire d'ajout ou sans appuyer sur le bouton submit
            $this->redirectTo("forum", "listCategories");
            // On redirige l'utilisateur vers le formulaire d'ajout de catégories
        
    }

    public function deleteCategorie($id) {
    // Fonction permettant de supprimer une catégorie
        $categorieManager = new CategorieManager();
        $forumController = new ForumController();

        $categorie = $categorieManager->delete($id);
        $redirect = $forumController->redirectTo("forum", "listCategories");

    }
}