<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 02.07.17
 * Time: 19:09
 */

namespace AppBundle\Controller;

use AppBundle\Form\AccountType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Account;



class editAccountController extends Controller
{

    /**
     * @Route("/account/{id}", name="edit_account", requirements={"id": "\d+"})
     */
    public function editAction($id, Request $request)
    {
        $account = $this->getDoctrine()
            ->getRepository('AppBundle:Account')
            ->find($id);
        if (!$account) {
            return $this->redirectToRoute('list_accounts');
        }
        return $this->handleForm($account, $request);
    }


    /**
     * @Route("/account/new", name="edit_new_account")
     */
    public function newAction(Request $request)
    {
        $account = new Account();
        return $this->handleForm($account, $request);
    }

    /**
     * @Route("/account/delete/{id}", name="delete_account", requirements={"id": "\d+"})
     */
    public function deleteAction($id, Request $request)
    {
        $account = $this->getDoctrine()
            ->getRepository('AppBundle:Account')
            ->find($id);
        if (!$account) {
            return $this->redirectToRoute('list_accounts');
        }

        // delete:
        $em = $this->getDoctrine()->getManager();
        $em->remove($account);
        $em->flush();

        return $this->redirectToRoute('list_accounts');
    }

    /**
     * @param Account $account
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    function handleForm(Account $account, Request $request) {
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { // save the data:
            $account = $form->getData();
            $em = $this->getDoctrine()->getManager();
            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $em->persist($account);
            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            return $this->redirectToRoute('list_accounts');
        }
        // show the form (again):
        return $this->render('editAccount.html.twig', array('form' => $form->createView()));
    }
}
