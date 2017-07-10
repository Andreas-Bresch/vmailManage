<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 07.07.17
 * Time: 21:36
 */

namespace AppBundle\Controller;

use AppBundle\Form\AliasType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Alias;

class EditAliasController extends Controller
{
    /**
     * @Route("/alias/{id}", name="edit_alias", requirements={"id": "\d+"})
     */
    public function editAction($id, Request $request)
    {
        $alias = $this->getDoctrine()
            ->getRepository('AppBundle:Alias')
            ->find($id);
        if (!$alias) {
            return $this->redirectToRoute('list_aliases');
        }
        return $this->handleForm($alias, $request);
    }


    /**
     * @Route("/alias/new", name="edit_new_alias")
     */
    public function newAction(Request $request)
    {
        $alias = new Alias();
        return $this->handleForm($alias, $request);
    }

    /**
     * @param Alias $alias
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    function handleForm(Alias $alias, Request $request) {
        $form = $this->createForm(AliasType::class, $alias);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { // save the data:
            $alias = $form->getData();
            $em = $this->getDoctrine()->getManager();
            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $em->persist($alias);
            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            return $this->redirectToRoute('list_aliases');
        }
        // show the form (again):
        return $this->render('editAlias.html.twig', array('form' => $form->createView()));
    }

}