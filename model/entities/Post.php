<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Post extends Entity{

    private $id;
    private $texte;
    private $creationDate;
    private $user;
    private $categorie;

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
     * Get the value of texte
     */ 
    public function getTexte(){
        return $this->texte;
    }

    /**
     * Set the value of texte
     *
     * @return  self
     */ 
    public function setTexte($texte){
        $this->texte = $texte;

        return $this;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate) {
        
        $unixTime = strtotime($creationDate);
        $newDate = date("d/m/Y à H:i", $unixTime);

        $this->creationDate = $newDate;
        return $this;
    }

    public function getCategorie(){
        return $this->categorie;
    }

    public function setCategorie($categorie){
        $this->categorie = $categorie;
        return $this;
    }

    public function __toString() {
        return $this->texte;
    }

}