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
        //récuperer les infos sur la catégories demander
        $mycat = $this->getDoctrine();
        $cat = $mycat->getRepository(Categories::class)->find($id);
        // recupere l'ensemble des produis de la catégories demander par rapport a id
        $listeProduit = $this->getDoctrine();
        $products = $listeProduit->getRepository(Products::class)->findByCat($id);
        // cela renvoie l'objet $cat en tableau dans cat idem pour produit
        return $this->render('categories/categories_show.html.twig',[
            'cat'=> $cat,
            'products'=> $products

        ]);
    }
}