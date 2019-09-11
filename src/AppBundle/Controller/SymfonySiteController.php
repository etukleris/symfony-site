<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use AppBundle\Form\UserProfileImageUpload;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/photos/{username}", name="user-photos", requirements={"username"=".+"})
     */
    public function photosByUserAction($username, Request $request)
    {
        $pictures = $this->getDoctrine()
          ->getRepository('AppBundle:Pictures')
          ->findByuseradded($username);
          
        return $this->render('SymfonySite/photos/photos.html.twig', array(
            'pictures' => $pictures
        ));
    }
     /**
     * @Route("/userprofile", name="user-profile-default")
     */
    public function userProfileDefaultAction( Request $request)
    {
        return $this->render('SymfonySite/user-profile-page/user-profile.html.twig');

    }
    
    /**
     * @Route("/userprofile/{username}", name="user-profile", requirements={"username"=".+"})
     */
    public function userProfileAction($username, Request $request)
    {
        
        $userInfo = $this->getDoctrine()
          ->getRepository('AppBundle:Users')
          ->findOneByuidusers($username);
          
        $user = new Users();
        $form = $this->createForm(UserProfileImageUpload::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imagefile */
            $imagefile = $form['imagefile']->getData();


            // so the image file must be processed only when a file is uploaded
            if ($imagefile) {
                $originalFilename = pathinfo($imagefile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                //$safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imagefile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imagefile->move(
                        $this->getParameter('uploaded_profile_pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'file name' property to store the image name
                // instead of its contents
                $userInfo->setImageuser($newFilename);
                
            }
            //$user->setUseradded($form->get('useradded')->getData());
            // ... merge the $user variable or any other work
            // 4) save the user!
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->merge($user);
            
            //*/
            $userInfo->setImageuser($newFilename);
            $entityManager->flush();
            return $this->redirect($request->getRequestUri());
        }
        
        return $this->render('SymfonySite/user-profile-page/user-profile-specific.html.twig', array(
            'userInfo' => $userInfo,
            'form' => $form->createView()
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
    
    //test authentication page
     /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}

