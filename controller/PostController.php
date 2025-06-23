<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class PostController extends AbstractController implements ControllerInterface {

    public function addMessage($id)
    {
        $session = new Session();
        $postManager = new PostManager();
        if(isset($_POST["submit"]))
        {
            $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $topicId = $id;
            
            if(isset($_SESSION["user"]))
            {
                $user = $_SESSION["user"];
                $userId = $user->getId();
            }
            else
            {
                $session->addFlash("error", "Veuillez vous connecter pour entrer un message !");
                $this->redirectTo("security", "loginPage"); exit;
            }

            if($texte && $topicId && $userId)
            {
                $postArray = array (
                    "texte" => $texte,
                    "topic_id" => $topicId,
                    "user_id" => $userId
                );
                
                $postManager->add($postArray);
                $session->addFlash("success", "Ajout du message avec succès !");
                $this->redirectTo("topic", "detailTopic", $id); exit;
            }
            else
            {
                $session->addFlash("error", "Veuillez saisir un message valide !");
                $this->redirectTo("topic", "detailTopic", $id); exit;
            }
            $this->redirectTo("topic", "detailTopic", $id); exit;
        }
    }

    public function deletePost($id)
    {
        $postManager = new PostManager();
        $session = new Session();
        $topicId = $_GET["topicId"];

        $postManager->delete($id);
        $session->addFlash("success", "Le message a bien été supprimé !");

        $this->redirectTo("topic", "detailTopic", $topicId); exit;
    }
}
