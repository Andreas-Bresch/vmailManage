<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 07.07.17
 * Time: 15:02
 */

namespace AppBundle\Controller;

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Domain;

class ListDomainsController extends Controller
{

    /**
     * @Route("/domain/", name="list_domains")
     */
    public function indexAction(Request $request)
    {
        $domains = $this->getDoctrine()
            ->getRepository('AppBundle:Domain')
            ->findAll();

        return $this->render('listDomains.html.twig', array('domains' => $domains));
    }

}