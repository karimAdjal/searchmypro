<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            // Envoyer l'e-mail
            $message = (new \Swift_Message('Nouveau message de contact'))
                ->setFrom($formData['email'])
                ->setTo('votre@email.com') // Remplacez par votre adresse e-mail
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        ['formData' => $formData]
                    ),
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            // Rediriger ou faire d'autres actions nécessaires
            return $this->redirectToRoute('accueil');
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}