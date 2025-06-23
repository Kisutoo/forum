<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\WarnManager;

class HomeController extends AbstractController implements ControllerInterface {

    public function index()
    {
        $userManager = new UserManager();

        $user = $userManager->findAll([]);

        return [
            "view" => VIEW_DIR."home.php",
            "titre" => "Accueil",
            "titre_secondaire" => "BIENVENUE SUR LE FORUM",
            "meta_description" => "Page d'accueil du forum",
            "data" => [
                "user" => $user
            ]
        ];
    }
        
    public function users(){
        $this->restrictTo("ROLE_USER");

        $manager = new UserManager();
        $users = $manager->findAll(['register_date', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
    }
}
