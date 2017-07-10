<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 07.07.17
 * Time: 21:05
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Alias;

class ListAliasesController extends Controller
{
    /**
     * @Route("/alias/", name="list_aliases")
     */
    public function indexAction(Request $request)
    {
        $aliases = $this->getDoctrine()
            ->getRepository('AppBundle:Alias')
            ->findAll();
        return $this->render('listAliases.html.twig', array('aliases' => $aliases));
    }
}