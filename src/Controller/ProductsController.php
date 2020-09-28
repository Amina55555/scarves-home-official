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
        
        $em = $this->getDoctrine();
        $product = $em->getRepository(Products::class)->find($id);
        $img = $this->getDoctrine();
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
        // page static donc on renvoie juste la route
        return $this->render('products/home.html.twig');
    }
    /**
     * @Route("/products", name="products")
     */
    public function products()
    {
        // appel a la methode getDoctrine
        $em = $this->getDoctrine();
        //Recupere tout les produit de la class Products
        $products= $em->getRepository(Products::class)->findAll();
        //afficher le nom en dur pour tout les produits à la place d'une catégorie en utilisant la meme page
        $cat = ['name'=>'tous nos Foulards'];
        return $this->render('categories/categories_show.html.twig',[
            'products' => $products,
            'cat' => $cat
        ]);

    }
    /**
     * @Route("/add_comments/{id}", name="add_comments")
     */   

     //parametre( requperer l'id, les reponses, interagir avec ma bases de données, récuper les infos utilisateur)
    public function add_comments($id, Request $request, EntityManagerInterface $entityManager, UserInterface $user)
    {
    // creation de l'objet addcomment vide 
    $addComment = new Comments(); 
    // créer un formulaire a partir du comment type
    $form = $this->createForm(CommentsType::class, $addComment);
    //recupere dans le request le form
    $form->handleRequest($request);

    //recuperer le produit concerné par le commentaire
    $prodId = $this->getDoctrine()->getRepository(Products::class)->find($id);

    // verifier que le form est valide et valider
    if ($form->isSubmitted() && $form->isValid()) {
        //rajoute a l'objet la date de crea du comment
        $addComment->setDate(new \DateTime());
         //rajoute a l'objet le user du comment
        $addComment->setUsers($user);
         //rajoute a l'objet le produit concerné par le comment
        $addComment->setProducts($prodId);

        //inserer a la base de donné 
        $entityManager->persist($addComment);
        $entityManager->flush();
        //renvoie vers la page products
        return $this->redirectToRoute('products', ['id'=>$id] );
    } 

    //afficher la page du formulaire
    return $this->render('comments/add_comments.html.twig',[
        'form' => $form ->createView(),
        'product' => $prodId
    ]);  
    } 
}