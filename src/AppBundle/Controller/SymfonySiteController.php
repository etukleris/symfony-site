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
     * @Route("/photos", name="photos")
     */
    public function photosAction(Request $request)
    {
        $pictures = $this->getDoctrine()
          ->getRepository('AppBundle:Pictures')
          ->findAll();
          
        return $this->render('SymfonySite/photos/photos.html.twig', array(
            'pictures' => $pictures
        ));
    }
    
    /**
     * @Route("/userprofile/{username}", name="userprofile/{username}", requirements={"username"=".+"})
     */
    public function userProfileAction($username, Request $request)
    {
        die("Hello world");
        $pictures = $this->getDoctrine()
          ->getRepository('AppBundle:Pictures')
          ->findAll();
          
        return $this->render('SymfonySite/user-profile-page/user-profile.html.twig', array(
            'pictures' => $pictures
        ));
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

