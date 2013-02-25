<?php

namespace MusicStation\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Event
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
     * @ORM\Column(name="location", type="text", nullable=true)
     */
    private $location;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\ManyToOne(targetEntity="MusicStation\UserBundle\Entity\Artist", inversedBy="events", cascade={"persist"})
     * @ORM\JoinColumn(name="artist_id", referencedColumnName="id")
     */
    protected $artist;

    /****************************************************************************************************
     * CUSTOM FUNCTIONS
     ***************************************************************************************************/

    /****************************************************************************************************
     * GETTERS AND SETTERS
     ***************************************************************************************************/

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
     * Set location
     *
     * @param string $location
     * @return Event
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set artist
     *
     * @param \MusicStation\UserBundle\Entity\Artist $artist
     * @return Event
     */
    public function setArtist(\MusicStation\UserBundle\Entity\Artist $artist = null)
    {
        $this->artist = $artist;
    
        return $this;
    }

    /**
     * Get artist
     *
     * @return \MusicStation\UserBundle\Entity\Artist 
     */
    public function getArtist()
    {
        return $this->artist;
    }
}