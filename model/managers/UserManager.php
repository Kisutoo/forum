<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    public function checkUserByMail($mail)
    // Verifie si un utilisateur est contenu en base de donnée grace à l'adresse mail
    {
        $sql = "SELECT *
                FROM ". $this->tableName. " t
                WHERE t.mail = :mail";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['mail' => $mail], false), 
            $this->className
        );
    }

    public function checkIfBannedByMail($mail)
    // Verifie l'état de bannissement ou non d'un utilisateur grace à son mail (permet de savoir si un utilisateur doit être considéré comme banni ou non lors de la connexion au forum)
    {
        $sql = "SELECT isBanned
                FROM ". $this->tableName. " t
                WHERE t.mail = :mail";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['mail' => $mail], false), 
            $this->className
        );
    }
    
    public function checkUserByNickName($nickName)
    // Récupère toutes les information d'un utilisateur grace à son pseudo si celui-ci existe en base de donnée
    {
        $sql = "SELECT *
                FROM ". $this->tableName. " t
                WHERE t.nickName = :nickName";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['nickName' => $nickName], false), 
            $this->className
        );
    }

    public function getPasswordByMail($mail)
    // Fonction retournant le hashage d'un mot de passe à laquelle une adresse mail est associée en base de donnée
    {
        $sql = "SELECT motDePasse
                FROM ". $this->tableName. " t
                WHERE t.mail = :mail";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['mail' => $mail], false), 
            $this->className
        );
    }

    public function banUnbanUser($state, $userId)
    // Change le booleen de true à false et inversement, permet de savoir si un utilisateur doit être considéré comme banni ou non
    {

        $sql = "UPDATE " .$this->tableName.
                " SET isBanned = :isBanned
                WHERE id_user = :id";
                
        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $userId, "isBanned" => $state], false), 
            $this->className
        );
    }
}