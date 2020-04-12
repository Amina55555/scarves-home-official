<?php

namespace App\Controller;

use App\Entity\Pictures;
use App\Entity\Products;
use App\Entity\Categories;
use App\Form\AddProductType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProductsRepository;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products/{id}", name="product")
     */
    public function product($id) 
    {
        $img = $this->getDoctrine();
        $em = $this->getDoctrine();
        $product = $em->getRepository(Products::class)->find($id);
        $images = $img->getRepository(Pictures::class)->findByProd($id);
        

        return $this->render('products/products.html.twig', [
            'product' => $product,
            'images' => $images
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('products/home.html.twig');
    }
    /**
     * @Route("/products", name="products")
     */
    public function products()
    {
        $em = $this->getDoctrine();
        $products= $em->getRepository(Products::class)->findAll();
        $cat = ['name'=>'tous nos Foulards'];
        return $this->render('categories/categories_show.html.twig',[
            'products' => $products,
            'cat' => $cat
        ]);

    }
    
   
}