<?php

namespace Videl\TNGroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroupRights
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Videl\TNGroupBundle\Entity\GroupRightsRepository")
 */
class GroupRights
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
     * @ORM\OneToOne(targetEntity="TNGroup")
     */
    private $inheritedFrom;

    /**
     * @ORM\ManyToOne(targetEntity="TNGroup", inversedBy="rights")
     */
    private $group;

    /**
     * @ORM\OneToOne(targetEntity="Action")
     */
    private $action;


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
     * Set inheritedFrom
     *
     * @param \Videl\TNGroupBundle\Entity\TNGroup $inheritedFrom
     * @return GroupRights
     */
    public function setInheritedFrom(\Videl\TNGroupBundle\Entity\TNGroup $inheritedFrom = null)
    {
        $this->inheritedFrom = $inheritedFrom;

        return $this;
    }

    /**
     * Get inheritedFrom
     *
     * @return \Videl\TNGroupBundle\Entity\TNGroup 
     */
    public function getInheritedFrom()
    {
        return $this->inheritedFrom;
    }

    /**
     * Set group
     *
     * @param \Videl\TNGroupBundle\Entity\TNGroup $group
     * @return GroupRights
     */
    public function setGroup(\Videl\TNGroupBundle\Entity\TNGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Videl\TNGroupBundle\Entity\TNGroup 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set action
     *
     * @param \Videl\TNGroupBundle\Entity\Action $action
     * @return GroupRights
     */
    public function setAction(\Videl\TNGroupBundle\Entity\Action $action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return \Videl\TNGroupBundle\Entity\Action 
     */
    public function getAction()
    {
        return $this->action;
    }
}
