<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class WarnManager extends Manager {

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Warn";
    protected $tableName = "warn";

    public function __construct(){
        parent::connect();
    }

}