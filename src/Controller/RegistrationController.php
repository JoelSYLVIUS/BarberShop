<?php

// src/Controller/RegistrationController.php
namespace App\Controller;

use App\Form\RegisterType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            $message = (new \Swift_Message("Inscription"))
                ->setFrom('admin@example.com')
                ->setTo('user@testmail.com')
                ->setBody(
                    $this->renderView(
                        // templates/emails/registration.html.twig
                        'Email/subscription.html.twig',
                        ['mail' => "user@testmail.com"]
                    ),
                    'text/html'
            );

            $mailer->send($message);

            return $this->render(
                'Front/default/home.html.twig',
                array('bg' => 'bg_carte')
            );
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView(), 'bg' => 'bg_carte')
        );
    }
}