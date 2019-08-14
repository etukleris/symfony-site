<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use AppBundle\Form\UserSignUp;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends Controller
{
    /**
    * @Route("/login", name="login")
    */
    public function loginAction()
    {
          $authenticationUtils = $this->get('security.authentication_utils');
          // get the login error if there is one
          $error = $authenticationUtils->getLastAuthenticationError();

          // last username entered by the user
          $lastUsername = $authenticationUtils->getLastUsername();

          return $this->render('SymfonySite/security/login.html.twig', [
              'last_username' => $lastUsername,
              'error'         => $error,
          ]);
    }
    
    /**
    * @Route("/signup", name="user_signup")
    */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new Users();
        $form = $this->createForm(UserSignUp::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPwdusers($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('login');
        }

        return $this->render(
            'SymfonySite/security/signup.html.twig',
            ['form' => $form->createView()]
        );
    }
}