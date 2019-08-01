<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SymfonySiteController extends Controller
{
    /**
     * @Route("/testpage", name="symfony-site")
     */
    public function indexAction(Request $request)
    {
        return $this->render('SymfonySite/index.html.twig');
    }
    
     /**
     * @Route("/testpage/create", name="symfony-site-create")
     */
    public function createAction(Request $request)
    {
        return $this->render('SymfonySite/create.html.twig');
    }
    
     /**
     * @Route("/testpage/edit/{id}", name="symfony-site-edit")
     */
    public function editAction($id, Request $request)
    {
        return $this->render('SymfonySite/edit.html.twig');
    }
    
     /**
     * @Route("/testpage/details/{id}", name="symfony-site-details")
     */
    public function detailsAction($id, Request $request)
    {
        return $this->render('SymfonySite/details.html.twig');
    }
}
