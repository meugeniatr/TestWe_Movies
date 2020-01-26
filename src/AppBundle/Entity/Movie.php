<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MovieRepository")
 */
class Movie
{
    const REFERENCE = "AppBundle:Movie";

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
     * @var int
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Type")
     * @ORM\JoinTable(name="movie_has_type",
     *      joinColumns={@ORM\JoinColumn(name="Movie_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Type_id", referencedColumnName="id")}
     *      )
     */
    private $type;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MovieHasPeople", mappedBy="movie", cascade={"persist", "remove", "merge"})
     */
    private $people;

    public function Movie() {
        $this->type = new ArrayCollection();
        $this->person = new ArrayCollection();
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
     * @return Movie
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
     * Set duration
     *
     * @param integer $duration
     *
     * @return Movie
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    public function getType()
    {
        if ($this->type == null) {
            return [];
        }
        return $this->type->toArray();
    }

    public function setType($types) {
        if($this->type == null) {
            $this->type = new ArrayCollection();
        }

        foreach ($types as $type) {
            $this->type->add($type);
        }
    }

    /**
     * @return array
     */
    public function getPeople()
    {
        if($this->people == null) {
            $this->people = new ArrayCollection();
        }
        return $this->people->toArray();
    }

    /**
     * @param array $people
     */
    public function setPeople($people)
    {
        if($this->people == null) {
            $this->people = new ArrayCollection();
        }

        foreach ($people as $person) {
            $this->people->add($person);
        }
    }

}

