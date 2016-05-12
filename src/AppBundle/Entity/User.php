<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class User {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank()
     */
    private $isAdmin;

    /*
    *   GETTERS
    */

        public function getId() {
            return $this->id;
        }
        public function getUsername() {
            return $this->username;
        }
        public function getPassword() {
            return $this->password;
        }
        public function getIsAdmin() {
            return $this->isAdmin;
        }

    /*
    *   SETTERS
    */

        public function setId($id) {
            $this->id = $id;
        }
        public function setUsername($username) {
            $this->username = $username;
        }
        public function setPassword($password) {
            $this->password = $password;
        }
        public function setIsAdmin($isAdmin) {
            $this->isAdmin = $isAdmin;
        }
}
