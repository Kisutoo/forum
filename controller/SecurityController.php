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
                    $session->addFlash("error", "Adresse mail déjà utilisée veuillez en choisir une autre");
                    $this->redirectTo("security", "registerPage"); exit;
                    // Message d'erreur, mail déjà utilisé en base de donné puis redirection sur la page d'inscription
                }
                elseif($userNickName)
                {
                    $session->addFlash("error", "Pseudonyme déjà utilisé, veuillez en choisir un autre");
                    $this->redirectTo("security", "registerPage"); exit;
                    // Message d'erreur, pseudo déjà utilisé en base de donné puis redirection sur la page d'inscription
                }
                else
                {
                    if($pass1 == $pass2 && preg_match($password_regex, $pass1) == 1)
                    // On vérifie si le mot de passe saisi est équivalent au champ pour confirmer celui ci et si il respecte bien la regex(règles de mots de passe)
                    // Si oui, on rentre les infos saisies dans un tableau associatif dans le but de l'ajouter à la base de donnée
                    {
                        $userArray = [
                            "mail" => $mail,
                            "nickName" => $nickName,
                            "motDePasse" => password_hash($pass1, PASSWORD_DEFAULT)
                            // On hash le mot de passe pour ne passe qu'on puisse le récupérer en clair dans la base de donnée

                        ];
                        // Tableau associatif avec les informations de l'utilisateur saisies dans le formulaire
                        $userManager->add($userArray);
                        // Ajout en base de donnée
                        $this->redirectTo("security", "loginPage"); exit;
                        // Redirection vers la page de connection si tout s'est bien passé
                    }
                    if($pass1 != $pass2 && preg_match($password_regex, $pass1) == 1)
                    // Si le mot de passe et la confirmation de celui ci ne sont pas équivalents, on affiche un message d'erreur puis on redirige l'utilisateur vers la page d'inscription
                    {   
                        $session->addFlash("error", "Les deux mots de passe saisis ne sont pas équivalents");
                        $this->redirectTo("security", "registerPage"); exit;
                    }
                    else
                    // Si le mot de passe saisi ne respecte pas la regex ...
                    {
                        $session->addFlash("error", "Le mot de passe saisi ne respecte pas les normes de mot de passe");
                        $this->redirectTo("security", "registerPage"); exit;
                    }
                }
            }
            else
            // Si après avoir été filtré dans les champs d'inscription, toutes les variables n'ont pas pu avoir de valeurs 
            {
                $session->addFlash("error", "Veuillez saisir des valeurs correctes");
                $this->redirectTo("security", "registerPage"); exit;
            }
        }
        else
        // Si on accède à cette fonction via l'url sans appuyer sur le bouton submit ou valider le formulaire
        {
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
    
    public function login() 
    {
        $userManager = new UserManager();
        $session = new Session();
        if(isset($_POST["submit"]))
        {
            $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // On sanitize les champs rentrés dans le formulaire

            if($mail && $password)
            {
                $user = $userManager->checkUserByMail($mail);
                // Si l'utilisateur existe en base de donné (vérification via le mail)
                if($user)
                // Si l'utilisateur existe
                {
                    $hash = $user->getMotDePasse();
                    // On récupère son mot de passe hashé en base de donné
                    if(password_verify($password, $hash) == true)
                    // Si le mot de passe rentré en formulaire, correspond au mot de passe haché de la base de donné (vérification faire grace à password_verify)
                    {
                        $session->setUser($user);
                        // On rentre l'utilisateur dans le tableau de session avec ses information (pseudo, mail, photo de profil etc)
                        $this->redirectTo("home", "index");
                    }
                    else
                    {
                        $session->addFlash("error", "Mail ou mot de passe incorrect");
                        $this->redirectTo("security", "loginPage"); exit;
                        //Message d'erreur + redirection si on ne trouve pas de mail ou si le mot de passe saisi n'est pas le bon
                    }
                }
                else
                {
                    $session->addFlash("error", "Mail ou mot de passe incorrect");
                    $this->redirectTo("security", "loginPage"); exit;
                    //Message d'erreur + redirection si on ne trouve pas de mail ou si le mot de passe saisi n'est pas le bon
                }
            }
            else
            {
                $session->addFlash("error", "Veuillez saisir des information correctes");
                $this->redirectTo("security", "loginPage"); exit;
            }
        }
        else
        {
            $this->redirectTo("security", "loginPage"); exit;
        }
    }
    
    public function logout() 
    {
        unset($_SESSION["user"]);
        // On supprime le tableau de session qui contient l'utilisateur que l'on a rentré précédemment dans la fonction login grace à la fonction "setUser" de la class Session
        $this->redirectTo("home", "index"); exit;
        // Redirection vers la page d'accueil
    }
}

// définir hasher, et la différence entre hasher, encoder et chiffrer + cas d'utilisation

    // Hasher : Sens unique/irreversible ,  consiste à convertir les mots de passe en une chaîne alphanumérique à l’aide d’algorithmes (ne pas stocker les information sensibles en clair dans la base de donnée, dans le cas ou l'on venait à se la faire pirater ou si celle ci fuitait)
    // Chiffrer : Double sens/reversible ,  Converti également les mots de passe en chaine alphanumérique mais peu être retransformer en texte clair si on possède la clef de chiffrement (empecher le vol de données, la modification de celles ci ou empecher tout accès non autorisé si l'on possède pas la clef de chiffrement)
    // Encoder : convertir des données dans un format déterminé (compression de donnée)
// Pourquoi utiliser un algorithme fort : Certains algorithmes sont réputés fort cas il n'existe à ce jour pas encore de dictionnaire repertoriant toutes les possibilités d'empreinte numériques, ce qui rend les attaques bruteforce beaucoup plus difficile
// définir empreinte numérique : le résultat obtenu via un algorithme de hash, chaine de caractères avec cost, sel, hash
// Le sel sert à lutter contre les attaques par analyse fréquentielle, les attaques utilisant des rainbow tables, les attaques par dictionnaire et les attaques par force brute en ajoutant des données aléatoires aux mots de passe avant le hachage
?>
