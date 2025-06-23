<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Warn extends Entity{

    private $post;
    private $user;
    private $warnDate; 

    public function __construct($data){         
        $this->hydrate($data);        
    }
    
    public function setPost($post)
    {
        $this->post = $post;
        return $this;
    }

    public function getPost()
    {
        return $this;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this;
    }

    public function setWarnDate($warnDate)
    {
        $this->warnDate = $warnDate;
        return $this;
    }

    public function __toString()
    {
        return $this->post;
    }
}