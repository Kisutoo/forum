<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;

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
        if(isset($_GET["submit"]))
        {
            $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $nickName = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($mail && $nickName && $pass1)
            {
                $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
                if($pass1 = $pass2 && preg_match($password_regex, $pass1))
                {
                    
                }
            }
            else
            {
                $securityController->redirectTo("security", "registerPage");
            }
        }
        else
        {
            var_dump(preg_match($password_regex, $pass1));
                    die;
            $securityController->redirectTo("security", "registerPage"); exit;
        }
    }
    public function login() {

    }
    public function logout() {
        
    }
}