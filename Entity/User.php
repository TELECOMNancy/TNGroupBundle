<?php

namespace Videl\TNGroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Videl\TNGroupBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\ManyToMany(targetEntity="TNGroup", mappedBy="members")
     */
    private $groups;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return TNUser
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
     * Set firstName
     *
     * @param string $firstName
     * @return TNUser
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return TNUser
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isActive = true;
    }

    /**
     * Add groups
     *
     * @param \Videl\TNGroupBundle\Entity\TNGroup $groups
     * @return User
     */
    public function addGroup(\Videl\TNGroupBundle\Entity\TNGroup $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Videl\TNGroupBundle\Entity\TNGroup $groups
     */
    public function removeGroup(\Videl\TNGroupBundle\Entity\TNGroup $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }

    public function __toString()
    {
        return $this->getEmail();
    }

    /** UserInterface interface */

    public function getRoles()
    {
        return array('ROLE_TNANCY');
    }

    public function getPassword()
    {
        return ' ';
    }

    public function getSalt()
    {
        return null;
    }

    public function getPrettyName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName() . ' (' . $this->getEmail() . ')';
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {

    }

    /** Serializable interface */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->email,
            $this->firstName,
            $this->lastName,
            $this->groups
        ));
    }
    public function unserialize($data) {
        list(
            $this->id,
            $this->email,
            $this->firstName,
            $this->lastName,
            $this->groups
        ) = unserialize($data);
    }
}
