<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\InscriptionType;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_inscription")
     */
    public function Registration(MailerInterface $mailer, Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new Users();

        $form = $this->createForm(InscriptionType::class, $user);
           // récuparation la requette
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            // $hash=$utilisateur->getMdp();
            $user->setPassword($hash);

            $user->setRoles('ROLE_USER');

            $newsletter=$user->getNewsletter();

            $manager->persist($user);
            $manager->flush();

            $email=(new Email())
            ->from('amina.boudjemline@gmail.com')
            ->to($user->getEmail())
            ->subject('test mail')
            ->html('<h1>Hello '.$user->getFirstName().' bienvenue sur ScarvesHome</h1>');
            $mailer->send($email);

            // return $this->redirectToRoute('security_login');
            return $this->render('security/login.html.twig',[
                'user'=> $user,
                'request'=>$request
            ]);
        }


        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/connexion", name="security_login")
    */
    public function login(){
    return $this->render('security/login.html.twig');
}
    /**
    * @Route("/logout", name="logout")
    */
    public function logout(){
//     return $this->render('security/login.html.twig');
}

}
