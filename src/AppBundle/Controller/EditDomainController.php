<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 07.07.17
 * Time: 15:09
 */

namespace AppBundle\Controller;

use AppBundle\Entity\DomainNewItem;
use AppBundle\Entity\DomainEditItem;
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
        // workaround because of unsupported database-structure (foreign key is not primary key)
        $domain = new DomainNewItem();
        return $this->handleFormNewItem($domain, $request);
    }

    /**
     * @Route("/domain/{id}", name="edit_domain", requirements={"id": "\d+"})
     */
    public function editAction($id, Request $request)
    {
        // workaround because of unsupported database-structure (foreign key is not primary key)
        $domain = $this->getDoctrine()
            ->getRepository('AppBundle:DomainEditItem')
            ->find(array('id' => $id));
        if (!$domain) {
            return $this->redirectToRoute('list_domains');
        }
        return $this->handleFormEditItem($domain, $request);
    }

    /**
     * @Route("/domain/delete/{id}", name="delete_domain", requirements={"id": "\d+"})
     */
    public function deleteAction($id, Request $request)
    {
        $domain = $this->getDoctrine()
            ->getRepository('AppBundle:Domain')
            ->findOneBy(array('id' => $id));
        if (!$domain) {
            return $this->redirectToRoute('list_domains');
        }

        // delete:
        $em = $this->getDoctrine()->getManager();
        $em->remove($domain);
        $em->flush();

        return $this->redirectToRoute('list_domains');

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
            $em->persist($domain);
            $em->flush();
            return $this->redirectToRoute('list_domains');
        }
        // show the form (again):
        $session = $request->getSession();
        return $this->render('editDomain.html.twig', array(
            'form' => $form->createView()));
    }


    /**
     *
     * workaround because of unsupported database-structure (foreign key is not primary key)
     *
     * @param DomainNewItem $domain
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    function handleFormEditItem(DomainEditItem $domain, Request $request) {
        $form = $this->createForm(DomainType::class, $domain);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { // save the data:
            $domain = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($domain);
            $em->flush();
            return $this->redirectToRoute('list_domains');
        }
        // show the form (again):
        return $this->render('editDomain.html.twig', array(
            'form' => $form->createView()));
    }


    /**
     *
     * workaround because of unsupported database-structure (foreign key is not primary key)
     *
     * @param DomainNewItem $domain
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    function handleFormNewItem(DomainNewItem $domain, Request $request) {
        $form = $this->createForm(DomainType::class, $domain);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { // save the data:
            $domain = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($domain);
            $em->flush();
            return $this->redirectToRoute('list_domains');
        }
        // show the form (again):
        return $this->render('editDomain.html.twig', array(
            'form' => $form->createView()));
    }

}