<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SymfonySiteController extends Controller
{
    /**
     * @Route("/index", name="site-index")
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
    
    //css static pages
    /**
     * @Route("/css1", name="css1page")
     */
    public function css1pageAction(Request $request)
    {
        return $this->render('SymfonySite/csstests/csstest1.html.twig');
    }
    /**
     * @Route("/css2", name="css2page")
     */
    public function css2pageAction(Request $request)
    {
        return $this->render('SymfonySite/csstests/csstest2.html.twig');
    }
    /**
     * @Route("/css3", name="css3page")
     */
    public function css3pageAction(Request $request)
    {
        return $this->render('SymfonySite/csstests/csstest3.html.twig');
    }
    /**
     * @Route("/css4", name="css4page")
     */
    public function css4pageAction(Request $request)
    {
        return $this->render('SymfonySite/csstests/csstest4.html.twig');
    }
    /**
     * @Route("/css5", name="css5page")
     */
    public function css5pageAction(Request $request)
    {
        return $this->render('SymfonySite/csstests/csstest5.html.twig');
    }
    /**
     * @Route("/css6", name="css6page")
     */
    public function css6pageAction(Request $request)
    {
        return $this->render('SymfonySite/csstests/csstest6.html.twig');
    }
    
    /**
     * @Route("/dummy", name="dummypage")
     */
    public function dummypageAction(Request $request)
    {
        return $this->render('SymfonySite/dummy.html.twig');
    }
}
