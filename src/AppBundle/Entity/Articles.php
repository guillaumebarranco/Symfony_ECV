<?php

namespace AppBundle\Entity;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Articles {

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
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="articles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @ORM\Column(type="string")
     */
    protected $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /*
    *   GETTERS
    */

        public function getId() {
            return $this->id;
        }
        public function getTitle() {
            return $this->title;
        }
        public function getAuthor() {
            return $this->author;
        }
        public function getContent() {
            return $this->content;
        }

    /*
    *   SETTERS
    */

        public function setId($id) {
            $this->id = $id;
        }
        public function setTitle($title) {
            $this->title = $title;
        }
        public function setAuthor($author) {
            $this->author = $author;
        }
        public function setContent($content) {
            $this->content = $content;
        }
        public function setSlug($slug) {
            $slug = str_replace(' ', '_', $slug);
            $slug = strtolower($slug);
            $slug = substr($slug, 0, 30);

            $this->slug = $slug;
        }

        public function setCreatedAt() {
            $this->created_at = new \Datetime();
        }
        public function setUpdatedAt() {
            $this->updated_at = new \Datetime();
        }

}
