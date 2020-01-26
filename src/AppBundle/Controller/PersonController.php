<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 12/05/2018
 * Time: 12:44
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Person;
use AppBundle\Form\PersonForm;
use AppBundle\Services\PersonService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PersonController
 * @Route("/person")
 * @package AppBundle\Controller
 */
class PersonController extends Controller
{

    /**
     * @Route("/", name="listPerson")
     * @Template("Person/index.html.twig")
     * @return array
     */
    public function listAction()
    {
        $personService = $this->container->get('person_service');
        $people = $personService->getAllPeople();

        return ["people" => $people];
    }


    /**
     * @Route("/create", name="newPerson")
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $personService = $this->container->get('person_service');

        $person = new Person();
        $form = $this->createForm(PersonForm::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $personService->savePerson($person);
            return $this->redirect($this->generateUrl("listPerson"));
        }

        return $this->render('person/new.html.twig', ['form_person' => $form->createView()]);
    }

    /**
     * @Route("/edit/{person}", name="editPerson")
     * @ParamConverter("person", class="AppBundle:Person")
     * @param Request $request
     * @param Person $person
     * @return Response
     */
    public function editAction(Request $request, Person $person)
    {
        /** @var PersonService $personService */
        $personService = $this->container->get('person_service');
        $form = $this->createForm(PersonForm::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $personService->savePerson($person);
            return $this->redirect($this->generateUrl("listPerson"));
        }

        return $this->render('person/new.html.twig', ['form_person' => $form->createView()]);
    }

    /**
     * @Route("/delete/{person}", name="deletePerson")
     * @ParamConverter("person", class="AppBundle:Person")
     * @param Person $person
     * @return Response
     */
    public function deleteAction(Person $person) {
        if ($person != null) {
            $personService = $this->container->get('person_service');
            $personService->deletePerson($person);
        }

        return $this->redirect($this->generateUrl("listPerson"));
    }

    /**
     * @Route("/{person}/movies", name="showMovies")
     * @ParamConverter("person", class="AppBundle:Person")
     * @param Person $person
     * @return Response
     */
    public function showMoviesAction(Person $person)
    {
        $personService = $this->get('person_service');
        $movies = $personService->getMoviesOf($person);

        return $this->render('person/movies.html.twig', ['movies' => $movies]);
    }
}