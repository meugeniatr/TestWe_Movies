<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieHasPeople
 *
 * @ORM\Table(name="movie_has_people")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MovieHasPeopleRepository")
 */
class MovieHasPeople
{

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="significance", type="string", length=255, nullable=true)
     */
    private $significance;

    /**
     * @var Person
     *
     * @ORM\Id
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="movies", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="people_id", referencedColumnName="id")
     * })
     */
    private $person;

    /**
     * @var Movie
     *
     * @ORM\Id
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Movie", inversedBy="people", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="movie_id", referencedColumnName="id")
     * })
     */
    private $movie;


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
     * Set role
     *
     * @param string $role
     *
     * @return MovieHasPeople
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set significance
     *
     * @param string $significance
     *
     * @return MovieHasPeople
     */
    public function setSignificance($significance)
    {
        $this->significance = $significance;

        return $this;
    }

    /**
     * Get significance
     *
     * @return string
     */
    public function getSignificance()
    {
        return $this->significance;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * @return Movie
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @param Movie $movie
     */
    public function setMovie($movie)
    {
        $this->movie = $movie;
    }

}

