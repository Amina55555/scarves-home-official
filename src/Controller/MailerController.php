<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerController extends AbstractController
{
    /**
    * @Route("/Mail", name="Mail")
    */
    public function mail(MailerInterface $Mailer)
    {
        $email=(new Email())
      ->from('amina.boudjemline@gmail.com')
      ->to('aminou_26@hotmail.com')
      ->subject('test mail')
      ->text('Hello bienvenue sur ScarvesHome');
        $Mailer->send($email);
        return $this->redirectToRoute('home');
    }

    /**
    * @Route("/contact", name="contact")
    */
    public function contact(MailerInterface $Mailer, Request $request)
    {
        $contact = new Contact();
        $form =$this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email=(new Email())
        ->from($contact->getEmail())
        ->to('amina.boudjemline@gmail.com')
        ->subject($contact->getObject())
        ->text('Nouveau message de :'.$contact->getFirstname().' '.$contact->getLastname().' '. $contact->getMessage());
            $Mailer->send($email);
            return $this->redirectToRoute('home');
        }
        return $this->render('contact/contact.html.twig',[
          'form'=>$form->createView()
        ]);
    }
}





