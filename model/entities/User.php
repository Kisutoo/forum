<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity{

    private $id;
    private $nickName;
    private $mail;
    private $motDePasse;
    private $dateDInscription;
    private $photoDeProfil;
    private $role;
    private $isBanned;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of nickName
     */ 
    public function getNickName(){
        return $this->nickName;
    }

    /**
     * Set the value of nickName
     *
     * @return  self
     */ 
    public function setNickName($nickName){
        $this->nickName = $nickName;

        return $this;
    }

    public function __toString() {
        return $this->id;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this->mail;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
        return $this->motDePasse;
    }

    public function getDateDInscription()
    {
        return $this->dateDInscription;
    }

    public function setDateDInscription($dateDInscription)
    {
        $this->dateDInscription = $dateDInscription;
        return $this->dateDInscription;
    }

    public function getPhotoDeProfil()
    {
        return $this->photoDeProfil;
    }

    public function setPhotoDeProfil($photoDeProfil)
    {
        $this->photoDeProfil = $photoDeProfil;
        return $this->photoDeProfil;
    }

    public function hasRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $this->role;
    }

    public function setIsBanned($isBanned)
    {
        $this->isBanned = $isBanned;
        return $this;
    }

    public function getIsBanned()
    {
        return $this->isBanned;
    }

}