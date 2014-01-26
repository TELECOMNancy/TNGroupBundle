<?php

namespace Videl\TNGroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TNGroup
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Videl\TNGroupBundle\Entity\TNGroupRepository")
 */
class TNGroup
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="groups")
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity="GroupRights", mappedBy="group")
     */
    private $rights;

    /**
     * @ORM\OneToOne(targetEntity="TNGroup")
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rights = new \Doctrine\Common\Collections\ArrayCollection();
        $this->date = new \DateTime();
    }

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
     * Set name
     *
     * @param string $name
     * @return TNGroup
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
     * Set description
     *
     * @param string $description
     * @return TNGroup
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return TNGroup
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add members
     *
     * @param \Videl\TNGroupBundle\Entity\User $members
     * @return TNGroup
     */
    public function addMember(\Videl\TNGroupBundle\Entity\User $members)
    {
        $this->members[] = $members;

        return $this;
    }

    /**
     * Remove members
     *
     * @param \Videl\TNGroupBundle\Entity\User $members
     */
    public function removeMember(\Videl\TNGroupBundle\Entity\User $members)
    {
        $this->members->removeElement($members);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Add rights
     *
     * @param \Videl\TNGroupBundle\Entity\GroupRights $rights
     * @return TNGroup
     */
    public function addRight(\Videl\TNGroupBundle\Entity\GroupRights $rights)
    {
        $this->rights[] = $rights;

        return $this;
    }

    /**
     * Remove rights
     *
     * @param \Videl\TNGroupBundle\Entity\GroupRights $rights
     */
    public function removeRight(\Videl\TNGroupBundle\Entity\GroupRights $rights)
    {
        $this->rights->removeElement($rights);
    }

    /**
     * Get rights
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * Set parent
     *
     * @param \Videl\TNGroupBundle\Entity\TNGroup $parent
     * @return TNGroup
     */
    public function setParent(\Videl\TNGroupBundle\Entity\TNGroup $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Videl\TNGroupBundle\Entity\TNGroup 
     */
    public function getParent()
    {
        return $this->parent;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
