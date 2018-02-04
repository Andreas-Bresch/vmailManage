<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 02.07.17
 * Time: 19:02
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Account;

class ListAccountsController extends Controller
{

    /**
     * @Route("/account/", name="list_accounts")
     */
    public function indexAction(Request $request)
    {
        $accounts = $this->getDoctrine()
            ->getRepository('AppBundle:Account')
            ->findAll();
        return $this->render('listAccounts.html.twig', array('accounts' => $accounts));
    }

}




