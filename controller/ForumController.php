<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;

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
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function listTopics() {

        $topicManager = new TopicManager();
        $userManager = new UserManager();

        $topics = $topicManager->findAll(["title", "ASC"]);
        $user = $userManager->findAll(["nickName", "ASC"]);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics du forum",
            "data" => [
                "user" => $user,
                "topics" => $topics
            ]
        ];
    }

    public function listTopicsByCategorie($id) {

        $topicManager = new TopicManager();
        $categorieManager = new CategorieManager();
        $categorie = $categorieManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategorie($id);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$categorie,
            "data" => [
                "categorie" => $categorie,
                "sujet" => $topics
            ]
        ];
    }
}