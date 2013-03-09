<?php

namespace MusicStation\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Artist
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Artist
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
     * @var text
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var text
     *
     * @ORM\Column(name="bio", type="text", nullable=true)
     */
    private $bio;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="MusicStation\UserBundle\Entity\Event", mappedBy="artist", cascade={"persist"})
     */
    protected $events;

    /**
     * @ORM\OneToMany(targetEntity="MusicStation\UserBundle\Entity\Shout", mappedBy="artist", cascade={"persist"})
     */
    protected $shouts;

    /**
     * @ORM\OneToOne(targetEntity="MusicStation\UserBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /****************************************************************************************************
     * CUSTOM FUNCTIONS
     ***************************************************************************************************/

    public function __toString()
    {
        return $this->getName();
    }

    /****************************************************************************************************
     * GETTERS AND SETTERS
     ***************************************************************************************************/
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
        $this->shouts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Artist
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
     * Set bio
     *
     * @param string $bio
     * @return Artist
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    
        return $this;
    }

    /**
     * Get bio
     *
     * @return string 
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Artist
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add events
     *
     * @param \MusicStation\UserBundle\Entity\Event $events
     * @return Artist
     */
    public function addEvent(\MusicStation\UserBundle\Entity\Event $events)
    {
        $this->events[] = $events;
    
        return $this;
    }

    /**
     * Remove events
     *
     * @param \MusicStation\UserBundle\Entity\Event $events
     */
    public function removeEvent(\MusicStation\UserBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add shouts
     *
     * @param \MusicStation\UserBundle\Entity\Shout $shouts
     * @return Artist
     */
    public function addShout(\MusicStation\UserBundle\Entity\Shout $shouts)
    {
        $this->shouts[] = $shouts;
    
        return $this;
    }

    /**
     * Remove shouts
     *
     * @param \MusicStation\UserBundle\Entity\Shout $shouts
     */
    public function removeShout(\MusicStation\UserBundle\Entity\Shout $shouts)
    {
        $this->shouts->removeElement($shouts);
    }

    /**
     * Get shouts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShouts()
    {
        return $this->shouts;
    }

    /**
     * Set user
     *
     * @param \MusicStation\UserBundle\Entity\User $user
     * @return Artist
     */
    public function setUser(\MusicStation\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \MusicStation\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}