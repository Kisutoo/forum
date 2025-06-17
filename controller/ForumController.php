<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
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
        return [
            "view" => VIEW_DIR . "forum/addCategorieForm.php",
            "meta_description" => "Page pour ajouter une catégorie au forum",
            "titre" => "Ajouter une catégorie",
            "titre_secondaire" => "Ajouter une catégorie",
        ];
    }

    public function addCategorie() {
        if(isset($_POST['submit']))
        {
            $nomCategorie = filter_input(INPUT_POST, "nomCategorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $categorieManager = new CategorieManager();

            $categorie =
        }
    }

    // addCategory
}