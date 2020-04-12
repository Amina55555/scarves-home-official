<?php

namespace App\Controller;

use App\Entity\Products;
use App\Entity\Categories;
use App\Form\AddProductType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
   /**
    * @Route("/admin/newprod", name="products_create")
    */
    public function newprod(ObjectManager $manager, Request $request)
    {
        $newprod = new Products();
        $cats = $this->getDoctrine()->getRepository(Categories::class)->findAll();
        
        $form = $this->createForm(AddProductType::class, $newprod);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['picture']->getData();
            if ($file->getClientOriginalName()) {
                $targetpath = '../public/telecharger/';
                $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'bin';
                }
                $image = rand(1, 99999).'.'.$extension;
                $file->move($targetpath, $image);
                $newprod->setPicture($image);
            } else {
                $newprod -> setPicture('default.jpg');
            }
            $manager->persist($newprod);
            $manager->flush();

            return $this->redirectToRoute('products_create',);
        }

        return $this->render('admin/create.html.twig', [
               'form' => $form ->createView()   
           ]);
    }
}
