<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 07.07.17
 * Time: 15:09
 */

namespace AppBundle\Controller;

use AppBundle\Form\DomainType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Domain;

class EditDomainController extends Controller
{

    /**
     * @Route("/domain/new", name="edit_new_domain")
     */
    public function newAction(Request $request)
    {
        $domain = new Domain();
        return $this->handleForm($domain, $request);
    }

    /**
     * @Route("/domain/{id}", name="edit_domain", requirements={"id": "\d+"})
     */
    public function editAction($id, Request $request)
    {
        $domain = $this->getDoctrine()
            ->getRepository('AppBundle:Domain')
            ->findOneBy(array('id' => $id));
        if (!$domain) {
            return $this->redirectToRoute('list_domains');
        }
        return $this->handleForm($domain, $request);
    }

    /**
     * @Route("/domain/delete/{id}", name="edit_domain", requirements={"id": "\d+"})
     */
    public function deleteAction($id, Request $request)
    {
        $domain = $this->getDoctrine()
            ->getRepository('AppBundle:Domain')
            ->findOneBy(array('id' => $id));
        if (!$domain) {
            return $this->redirectToRoute('list_domains');
        }
        return $this->handleForm($domain, $request);
    }



    /**
     * @param Account $account
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    function handleForm(Domain $domain, Request $request) {
        $form = $this->createForm(DomainType::class, $domain);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { // save the data:
            $domain = $form->getData();
            $em = $this->getDoctrine()->getManager();
            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $em->persist($domain);
            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            return $this->redirectToRoute('list_domains');
        }
        // show the form (again):
        return $this->render('editDomain.html.twig', array('form' => $form->createView()));
    }

}