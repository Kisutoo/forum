<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategorie($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.categorie_id = :id";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    public function changeStateClosed($closed, $topicId)
    // Change l'état d'un topic d'ouvert à fermé et inversement
    {

        $sql = "UPDATE " .$this->tableName.
                " SET closed = :closed
                WHERE id_topic = :id";
                
        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $topicId, "closed" => $closed], false), 
            $this->className
        );
    }
}