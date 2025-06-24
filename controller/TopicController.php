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

class TopicController extends AbstractController implements ControllerInterface{
    
    public function listTopics() {

        $this->restrictTo("admin");
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

    public function addTopicForm($id) {
        
        $userManager = new UserManager();

        $users = $userManager->findAll();
        return [
            "view" => VIEW_DIR . "forum/addTopicForm.php",
            "meta_description" => "Page pour ajouter un topic à une catégorie",
            "titre" => "Ajouter un topic",
            "titre_secondaire" => "Ajouter un topic",
            "data" => [
                "users" => $users
            ]
        ];
    }

    public function addTopic($id) {
        
        if(isset($_POST['submit']))
        {
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $topicManager = new TopicManager();

            if(isset($_SESSION["user"]))
            {
                $user = $_SESSION["user"];
                $userId = $user->getId();
            }
            $topicArray = array (
                "title" => $title,
                "user_id" => $userId,
                "categorie_id" => $id
            );
            $topics = $topicManager->add($topicArray);
        }
        $topicController = new TopicController();
        $topicController->redirectTo("topic", "listTopicsByCategorie", $id);
    }

    public function deleteTopic($id) {
        $topicManager = new TopicManager();
        $topicController = new topicController();
        $idCategorie = $_GET["idCategorie"];

        $topic = $topicManager->delete($id);
        $redirect = $topicController->redirectTo("topic", "listTopicsByCategorie", $idCategorie);
    }

    public function openTopic($id)
    {
        $session = new Session();
        $topicManager = new TopicManager();

        $topicManager->changeStateClosed(0, $id);
        $session->addFlash("sucess", "Topic ouvert avec succès !");
        $this->redirectTo("topic", "detailTopic", $id);
    }

    public function closeTopic($id)
    {
        $session = new Session();
        $topicManager = new TopicManager();

        $topicManager->changeStateClosed(1, $id);
        $session->addFlash("sucess", "Topic clos avec succès !");
        $this->redirectTo("topic", "detailTopic", $id);
    }

    
}
?>