<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Pictures;
use AppBundle\Form\ImageUpload;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends Controller
{
    /**
     * @Route("/upload/new", name="upload_new_picture")
     */
    public function newAction(Request $request)
    {
        $picture = new Pictures();
        $form = $this->createForm(ImageUpload::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imagefile */
            $imagefile = $form['imagefile']->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imagefile) {
                $originalFilename = pathinfo($imagefile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                //$safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imagefile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imagefile->move(
                        $this->getParameter('uploaded_pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'file name' property to store the PDF file name
                // instead of its contents
                $picture->setImagename($newFilename);
                
            }
            $picture->setUseradded($form->get('useradded')->getData());
            // ... persist the $picture variable or any other work
            // 4) save the picture!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('site-index'));
        }

        return $this->render('SymfonySite/upload/upload-picture.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}