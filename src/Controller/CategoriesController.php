<?php

namespace App\Controller;

use App\Entity\Products;
use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
 /**
  * @Route("/categories/{id}", name="categories_show")
  */
    public function categories_show($id)
    {
        $mycat = $this->getDoctrine();
        $cat = $mycat->getRepository(Categories::class)->find($id);
        $listeProduit =$this->getDoctrine();
        $products = $listeProduit->getRepository(Products::class)->findByCat($id);

        return $this->render('categories/categories_show.html.twig',[
            'cat'=> $cat,
            'products'=> $products

        ]);
    }
}