<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 02.07.17
 * Time: 19:02
 */

namespace AppBundle\Controller;

use /** @noinspection PhpUnusedAliasInspection */
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use /** @noinspection PhpUnusedAliasInspection */
    AppBundle\Entity\Account;

/**
 * ListAccountsController class
 *
 * @package AppBundle\Controller
 */
class ListAccountsController extends Controller
{

    /**
     * @Route("/account/", name="list_accounts")
     * @throws \LogicException
     */
    public function indexAction() {
        $accounts = $this->getDoctrine()
            ->getRepository('AppBundle:Account')
            ->findAll();

        return $this->render( 'listAccounts.html.twig', [
            'accounts' => $accounts,
        ] );
    }

}




