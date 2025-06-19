<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;
use Model\Managers\PostManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function registerPage()
    {
        return [
            "meta_description" => "Page d'inscription du forum",
            "titre" => "S'inscrire",
            "titre_secondaire" => "Inscription au forum",
            "view" => VIEW_DIR."security/registerPage.php"
        ];
    }
    
    public function register() 
    {
        $securityController = new SecurityController();
        $userManager = new UserManager();
        $password_regex = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\W])(?=\S*[\d])\S*$^";
        if(isset($_POST["submit"]))
        {
            $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $nickName = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($mail && $nickName && $pass1 && $pass2)
            {
                
                $user = $userManager->checkUserByMail($mail);
                if($user)
                {
                    $securityController->redirectTo("security", "regiterPage");
                }
                else
                {
                    if($pass1 = $pass2 && preg_match($password_regex, $pass1) == 1)
                    {
                        $userArray = [
                            "mail" => $mail,
                            "nickName" => $nickName,
                            "motDePasse" => password_hash($pass1, PASSWORD_DEFAULT)
                        ];
                        $userManager->add($userArray);
                        $securityController->redirectTo("security", "loginPage"); exit;
                    }
                    else
                    {
                        $securityController->redirectTo("security", "registerPage"); exit;
                    }
                }
            }
            else
            {
                $securityController->redirectTo("security", "registerPage"); exit;
            }
        }
        else
        {
            $securityController->redirectTo("security", "registerPage"); exit;
        }
    }
    public function login() {

    }
    public function logout() {
        
    }
}