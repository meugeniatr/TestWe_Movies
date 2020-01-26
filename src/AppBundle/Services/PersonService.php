<?php

namespace AppBundle\Services;

use AppBundle\Entity\Movie;
use AppBundle\Entity\Person;
use AppBundle\Repository\MovieRepository;
use AppBundle\Repository\PersonRepository;
use Doctrine\ORM\EntityManager;

class PersonService
{
    /** @var EntityManager */
    protected $em;

    public function savePerson(Person $person) {
        $this->em->persist($person);
        $this->em->flush();
    }

    public function deletePerson(Person $person) {
        $this->em->remove($person);
        $this->em->flush();
    }

    public function getAllPeople() {
        return $this->getPersonRepository()->findAll();
    }

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * @return PersonRepository
     */
    public function getPersonRepository() {
        return $this->em->getRepository(Person::REFERENCE);
    }

    /**
     * @return MovieRepository
     */
    public function getMovieRepository() {
        return $this->em->getRepository(Movie::REFERENCE);
    }

    public function getMoviesOf(Person $person)
    {
        return $this->getMovieRepository()->getMoviesOf($person);
    }
}