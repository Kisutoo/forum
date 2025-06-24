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

class AdminController extends AbstractController implements ControllerInterface{

    public function warnMessage($id)
    // Fontion permettant de signaler un message, on affichera les messages signalés dans le panneau administrateur
    {
        $session = new Session();
        $warnManager = new WarnManager();
        $postManager = new PostManager();

        if(isset($_GET["topicId"]))
            $topicId = $_GET["topicId"];
        // On pourrait ne pas en avoir besoin, on vient juste prendre l'Id du topic pour renvoyer l'utilisateur vers le topic où le signalement a été effectué

        $user = $postManager->findUserByPostId($id);
        $userId = $user->getUser();
        
        $warnArray = array (
            "user_id" => $userId,
            "post_id" => $id
        );

        $warnManager->add($warnArray);
        $session->addFlash("error", "Message signalé");
        $this->redirectTo("topic", "detailTopic", $topicId);
    }

    public function adminPage()
    // Redirection vers la vue du panneau administrateur
    {
        $warnManager = new WarnManager();
        $userManager = new UserManager();

        $warns = $warnManager->findAll();
        $users = $userManager->findAll();
        $listUsers = $userManager->findAll();
        
        return [
            "meta_description" => "Page de modération reservée aux administrateurs du forum",
            "titre" => "Pannel Administrateur",
            "titre_secondaire" => "Pannel Administrateur",
            "view" => VIEW_DIR."forum/adminPage.php",
            "data" => [
                "warns" => $warns,
                "users" => $users,
                "listUsers" => $listUsers
            ]
        ];
    }

    public function adminDeletePost($id)
    // Cette fonction peut s'apparenter à la fonction deletePost, seul la redirection change réellement, on renvoie l'utilisateur vers la page admin au lieu de la page du topic
    {
        $postManager = new PostManager();
        $session = new Session();

        $postManager->delete($id);
        $session->addFlash("success", "Le message a bien été supprimé du topic !");

        $this->redirectTo("admin", "adminPage"); exit;
    }

    public function banUser($id)
    // Fontion permettant de bannir un utilisateur
    {
        $session = new Session();
        $userManager = new UserManager();

        $userManager->banUnbanUser(1, $id);
        $session->addFlash("sucess", "L'utilisateur à été banni");
        $this->redirectTo("admin", "adminPage");
    }

    public function unbanUser($id)
    // Fonction permattant de débannir un utilisateur
    {
        $session = new Session();
        $userManager = new UserManager();

        $userManager->banUnbanUser(0, $id);
        $session->addFlash("sucess", "L'utilisateur à été débanni");
        $this->redirectTo("admin", "adminPage");
    }
}