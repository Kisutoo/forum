<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager {

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct(){
        parent::connect();
    }

    public function findPostsByTopic($id) {
    // Fonction permettant de récupérer tous les posts d'un topic grace à l'ID du topic

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.topic_id = :id";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    public function findUserByPostId($id) 
    // Permet de trouver un utilisateur et toutes ses information grace à l'ID d'un post
    {
        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.id_post = :id";
       
        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], false), 
            $this->className
        );
    }

}