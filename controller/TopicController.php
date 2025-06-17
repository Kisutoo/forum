<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;
use Model\Managers\PostManager;

class TopicController extends AbstractController implements ControllerInterface{
    
    public function listTopics() {

        $topicManager = new TopicManager();
        $userManager = new UserManager();

        $topics = $topicManager->findAll(["title", "ASC"]);
        $user = $userManager->findAll(["nickName", "ASC"]);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics du forum",
            "titre" => "Topics",
            "titre_secondaire" => "Liste des Topics",
            "data" => [
                "user" => $user,
                "topics" => $topics
            ]
        ];
    }

    public function listTopicsByCategorie($id) {

        $topicManager = new TopicManager();
        $categorieManager = new CategorieManager();
        $userManager = new UserManager();

        $categorie = $categorieManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategorie($id);
        $user = $userManager->findAll(["nickName", "ASC"]);

        return [
            "view" => VIEW_DIR."forum/listTopicsByCategorie.php",
            "meta_description" => "Liste des topics par catégorie : ".$categorie->getNomCategorie(),
            "titre" => $categorie->getNomCategorie(),
            "titre_secondaire" => $categorie->getNomCategorie(),
            "data" => [
                "user" => $user,
                "topics" => $topics,
                "categorie" => $categorie
            ]
        ];
    }

    public function detailTopic($id) {

        $topicManager = new TopicManager();
        $userManager = new UserManager();
        $postManager = new PostManager();

        $posts = $postManager->findPostsByTopic($id);
        $topic = $topicManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "forum/detailTopic.php",
            "meta_description" => "Détail du post : " . $topic->getTitle(),
            "titre" => $topic->getTitle(),
            "titre_secondaire" => $topic->getTitle(),
            "data" => [
                "posts" => $posts,
                "topic" => $topic
            ]
        ];
    } 
}
?>