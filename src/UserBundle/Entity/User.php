<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected   $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PortfolioEntry", mappedBy="user", cascade={"remove"})
     */
    private $entries;

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
     * Add entry
     *
     * @param \AppBundle\Entity\PortfolioEntry $entry
     *
     * @return User
     */
    public function addEntry(\AppBundle\Entity\PortfolioEntry $entry)
    {
        $this->entries[] = $entry;

        return $this;
    }

    /**
     * Remove entry
     *
     * @param \AppBundle\Entity\PortfolioEntry $entry
     */
    public function removeEntry(\AppBundle\Entity\PortfolioEntry $entry)
    {
        $this->entries->removeElement($entry);
    }

    /**
     * Get entries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntries()
    {
        return $this->entries;
    }
}
