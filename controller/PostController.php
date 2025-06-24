<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\WarnManager;

class PostController extends AbstractController implements ControllerInterface {

    public function addMessage($id)
    // Fonction utilisée pour ajouter un message au topic
    {
        $session = new Session();
        $postManager = new PostManager();
        if(isset($_POST["submit"]))
        // Si on appuie sur le bouton submit du formulaire
        {
            $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // On filtre le texte rentré
            $topicId = $id;
            // On récupère l'Id du topic
            
            if(isset($_SESSION["user"]))
            // Ici on va venir récupérer l'Id de l'utilisateur dans le but d'associer un utilisateur à un post si celui ci est connecté même si en théorie, il ne devrait pas être possible d'accéder
            // au formulaire pour envoyer un message si personne n'est connecté au forum
            {
                $user = $_SESSION["user"];
                $userId = $user->getId();
            }
            else
            // Dans le cas ou personne n'est connecté au forum on va rediriger la personne vers la page de connexion
            {
                $session->addFlash("error", "Veuillez vous connecter pour entrer un message !");
                $this->redirectTo("security", "loginPage"); exit;
                
            }

            if($texte && $topicId && $userId)
            // Si les variables existent toujours après avoir été sanitisées
            {
                $postArray = array (
                    "texte" => $texte,
                    "topic_id" => $topicId,
                    "user_id" => $userId
                );
                // Création d'un tableau contenant les variables, associées au noms de colonnes de la table post
                
                $postManager->add($postArray);
                $session->addFlash("success", "Ajout du message avec succès !");
                $this->redirectTo("topic", "detailTopic", $id); exit;
                // Si le message a bien été ajouté, on redirige l'utilisateur sur le même topic avec un message lui spécifiant que tout s'est bien déroulé
            }
            else
            {
                $session->addFlash("error", "Veuillez saisir un message valide !");
                $this->redirectTo("topic", "detailTopic", $id); exit;
                // Sinon, on affiche un message d'erreur et on le redirige
            }
            $this->redirectTo("topic", "detailTopic", $id); exit;
            // redirection si on accède à cette fonction sans avoir appuyé sur submit
        }
    }

    public function deletePost($id)
    // Fonction utilisée dans le but de supprimer un message
    {
        $postManager = new PostManager();
        $session = new Session();
        $topicId = $_GET["topicId"];

        $postManager->delete($id);
        $session->addFlash("success", "Le message a bien été supprimé !");

        $this->redirectTo("topic", "detailTopic", $topicId); exit;
    }
}
