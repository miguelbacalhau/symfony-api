<?php

namespace miguel\BacalhauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use miguel\BacalhauBundle\Entity\User;

/**
 * Suggestion
 *
 * @ORM\Table(name="suggestion")
 * @ORM\Entity(repositoryClass="miguel\BacalhauBundle\Repository\SuggestionRepository")
 */
class Suggestion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var miguel\BacalhauBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="suggestions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="voted")
     */
    private $voters;

    /**
     * Class construtor
     */
    public function __construct()
    {
        $this->voters = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Suggestion
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Suggestion
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set author
     *
     * @param \miguel\BacalhauBundle\Entity\User $author
     *
     * @return Suggestion
     */
    public function setAuthor(User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \miguel\BacalhauBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add voter
     *
     * @param \miguel\BacalhauBundle\Entity\User $voter
     *
     * @return Suggestion
     */
    public function addVoter(User $voter)
    {
        $this->voters[] = $voter;

        return $this;
    }

    /**
     * Remove voter
     *
     * @param \miguel\BacalhauBundle\Entity\User $voter
     */
    public function removeVoter(\miguel\BacalhauBundle\Entity\User $voter)
    {
        $this->voters->removeElement($voter);
    }

    /**
     * Get voters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVoters()
    {
        return $this->voters;
    }
}
