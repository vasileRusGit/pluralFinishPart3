<?php

namespace Yoda\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Yoda\UserBundle\Entity\User;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Event
 *
 * @ORM\Table(name="yoda_event")
 * @ORM\Entity(repositoryClass="Yoda\EventBundle\Repository\EventRepository")
 */
class Event {

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
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Yoda\UserBundle\Entity\User",cascade={"persist"}, inversedBy="events")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $owner;
    
    /**
     * @Gedmo\Slug(fields={"name"}, updatable=true)
     * @ORM\Column(name="slug", unique=true)
     */
    private $slug;
    
    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    
    /** 
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;
    
    /**
     * @ORM\ManyToMany(targetEntity="Yoda\UserBundle\Entity\User")
     * @ORM\JoinTable(joinColumns={@ORM\JoinColumn(onDelete="CASCADE")},
     *                inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")})
     */
    private $attendees;
    
    public function __construct() {
        $this->attendees = new ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="text")
     */
    private $details;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Event
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Event
     */
    public function setTime($time) {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime() {
        return $this->time;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Event
     */
    public function setLocation($location) {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return Event
     */
    public function setDetails($details) {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails() {
        return $this->details;
    }

    /**
     * @return User
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * @return User $owner
     */
    public function setOwner(User $owner) {
        $this->owner = $owner;
    }
    
    /**
     * @return User
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * @return User $owner
     */
    public function setSlug($slug) {
        $this->slug = $slug;
    }

    /**
     * @return 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    /**
     * @return 
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }
    
    /**
     * @return ArrayCollection
     */
    public function getAttendees() {
        return $this->attendees;
    }
    
    public function hasAttendee(User $user)
    {
        return $this->getAttendees()->contains($user);
    }
}
