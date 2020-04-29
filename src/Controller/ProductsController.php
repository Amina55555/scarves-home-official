<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Comments;
use App\Entity\Pictures;
use App\Entity\Products;
use App\Entity\Categories;
use App\Form\CommentsType;
use App\Form\AddProductType;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products/{id}", name="product")
     */
    public function product($id) 
    {
        $comments = $this->getDoctrine()->getRepository(Comments::class)->findBy(
            ['products'=> $id],
            ['date'=> 'DESC'],
            15, 
            0
        );
        $img = $this->getDoctrine();
        $em = $this->getDoctrine();
        $product = $em->getRepository(Products::class)->find($id);
        // $images = $img->getRepository(Pictures::class)->findByProd($id);
        $images = $img->getRepository(Pictures::class)->findBy(
            ['Products' => $id],
            ['id' => 'DESC']
        );

        return $this->render('products/products.html.twig', [
            'product' => $product,
            'images' => $images,
            'comments' => $comments

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
    /**
     * @Route("/add_comments/{id}", name="add_comments")
     */   
    public function add_comments($id, Request $request, EntityManagerInterface $entityManager, UserInterface $user)
    {
    $addComment = new Comments(); 
    $form = $this->createForm(CommentsType::class, $addComment);
    $form->handleRequest($request);

    $prodId = $this->getDoctrine()->getRepository(Products::class)->find($id);
    if ($form->isSubmitted() && $form->isValid()) {
        $addComment->setDate(new \DateTime());
        $addComment->setUsers($user);
        
        $addComment->setProducts($prodId);

        $entityManager->persist($addComment);
        $entityManager->flush();
        return $this->redirectToRoute('products', ['id'=>$id] );
    } 


    return $this->render('comments/add_comments.html.twig',[
        'form' => $form ->createView(),
        'product' => $prodId
    ]);  
    } 
}