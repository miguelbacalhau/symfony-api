<?php

namespace miguel\BacalhauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use miguel\BacalhauBundle\Entity\Suggestion;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="miguel\BacalhauBundle\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email
     */
    private $email;

    /**
     * @var Doctrine\Common\Collections\ArrayCollection;
     *
     * @ORM\OneToMany(targetEntity="Suggestion", mappedBy="author")
     */
    private $suggestions;

    /**
     * @var Doctrine\Common\Collections\ArrayCollection;
     *
     * @ORM\ManyToMany(targetEntity="Suggestion", inversedBy="voters")
     * @ORM\JoinTable(name="users_votes")
     */
    private $voted;

    /**
     * Class construtor
     */
    public function __construct()
    {
        $this->suggestions = new ArrayCollection();
        $this->voted = new ArrayCollection();
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
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
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add suggestion
     *
     * @param \miguel\BacalhauBundle\Entity\Suggestion $suggestion
     *
     * @return User
     */
    public function addSuggestion(\miguel\BacalhauBundle\Entity\Suggestion $suggestion)
    {
        $this->suggestions[] = $suggestion;

        return $this;
    }

    /**
     * Remove suggestion
     *
     * @param \miguel\BacalhauBundle\Entity\Suggestion $suggestion
     */
    public function removeSuggestion(\miguel\BacalhauBundle\Entity\Suggestion $suggestion)
    {
        $this->suggestions->removeElement($suggestion);
    }

    /**
     * Get suggestions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSuggestions()
    {
        return $this->suggestions;
    }

    /**
     * Add voted
     *
     * @param \miguel\BacalhauBundle\Entity\Suggestion $voted
     *
     * @return User
     */
    public function addVoted(Suggestion $suggestion)
    {
        $this->voted[] = $suggestion;

        return $this;
    }

    /**
     * Remove voted
     *
     * @param \miguel\BacalhauBundle\Entity\Suggestion $voted
     */
    public function removeVoted(uggestion $suggestion)
    {
        $this->voted->removeElement($suggestion);
    }

    /**
     * Get voted
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVoted()
    {
        return $this->voted;
    }
}
