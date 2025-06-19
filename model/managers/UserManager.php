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
    {
        $sql = "SELECT *
                FROM ". $this->tableName. " t
                WHERE t.mail = :mail";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['mail' => $mail], false), 
            $this->className
        );
    }

    public function checkUserByNickName($nickName)
    {
        $sql = "SELECT *
                FROM ". $this->tableName. " t
                WHERE t.nickName = :nickName";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['nickName' => $nickName], false), 
            $this->className
        );
    }
}