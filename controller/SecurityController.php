<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\Session;
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
        $userManager = new UserManager();
        $session = new Session();
        $password_regex = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\W])(?=\S*[\d])\S*$^";
        // Avec cette chaine de caractère que l'on va donner à la fonction preg_match, on va vérifié que le mot de passe est bien aux normes (1 maj, 1 min etc)
        if(isset($_POST["submit"]))
        {
            $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $nickName = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // On sanitize les champs rentrés

            if($mail && $nickName && $pass1 && $pass2)
            // Si les variables existent après avoir été sanitize
            {
                
                $userMail = $userManager->checkUserByMail($mail);
                // On vérifie si le mail rentré est déjà en base de donnée, renvoie NULL si ce n'est pas le cas
                $userNickName = $userManager->checkUserByNickName($nickName);
                // On vérifie si le pseudo rentré est déjà en base de donnée renvoie NULL si ce n'est pas le cas
                if($userMail)
                {
                    // addFlash("Adresse mail déjà utilisée !");
                    $session->getFlash("error");
                    $this->redirectTo("security", "registerPage"); exit;
                    // Message d'erreur, mail déjà utilisé en base de donné puis redirection sur la page d'inscription
                }
                elseif($userNickName)
                {
                    $session->addFlash("error", "Pseudonyme déjà utilisé, veuillez en choisir un autre");
                    $this->redirectTo("security", "registerPage"); 
                    $session->getFlash("error");
                    exit;
                    // Message d'erreur, pseudo déjà utilisé en base de donné puis redirection sur la page d'inscription
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
                        $this->redirectTo("security", "loginPage"); exit;
                    }
                    else
                    {   
                        $session->getFlash("error");
                        $this->redirectTo("security", "registerPage"); exit;
                    }
                }
            }
            else
            {
                $session->getFlash("error");
                $this->redirectTo("security", "registerPage"); exit;
            }
        }
        else
        {
            $session->getFlash("error");
            $this->redirectTo("security", "registerPage"); exit;
        }
    }
    
    public function loginPage()
    {
        return [
            "meta_description" => "Page de connexion du forum",
            "titre" => "Se connecter",
            "titre_secondaire" => "Connexion au forum",
            "view" => VIEW_DIR."security/loginPage.php"
        ];
    }
    public function login() {

    }
    public function logout() {
        
    }
}