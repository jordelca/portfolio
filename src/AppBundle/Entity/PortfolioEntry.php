<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PortfolioEntry
 *
 * @ORM\Table(name="portfolio_entry")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PortfolioEntryRepository")
 */
class PortfolioEntry
{
    const TYPE_JOB = '1';
    const TYPE_EDUCATION = '2';
    const TYPE_PERSONAL_PROJECT= '3';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company", inversedBy="entries")
     */
    private $company;

    /**
     * @var int
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TechSkill", mappedBy="entries")
     */
    private $techSkills;

    /**
     * @var array
     *
     * @ORM\Column(name="url", type="array")
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", nullable=false)
     */
    private $order;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;


    /**
     * @var boolean
     *
     * @ORM\Column(name="finished", type="boolean")
     */
    private $finished;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="entries")
     */
    private $user;


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
     * Set company
     *
     * @param integer $company
     *
     * @return PortfolioEntry
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return int
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set url
     *
     * @param array $url
     *
     * @return PortfolioEntry
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return array
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return PortfolioEntry
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
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return boolean
     */
    public function isFinished()
    {
        return $this->finished;
    }

    /**
     * @param boolean $finished
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }


    /**
     * Get finished
     *
     * @return boolean
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return PortfolioEntry
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->techSkills = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add techSkill
     *
     * @param \AppBundle\Entity\TechSkill $techSkill
     *
     * @return PortfolioEntry
     */
    public function addTechSkill(\AppBundle\Entity\TechSkill $techSkill)
    {
        $this->techSkills[] = $techSkill;

        return $this;
    }

    /**
     * Remove techSkill
     *
     * @param \AppBundle\Entity\TechSkill $techSkill
     */
    public function removeTechSkill(\AppBundle\Entity\TechSkill $techSkill)
    {
        $this->techSkills->removeElement($techSkill);
    }

    /**
     * Get techSkills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTechSkills()
    {
        return $this->techSkills;
    }
}
