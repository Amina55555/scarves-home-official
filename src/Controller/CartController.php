<?php

namespace App\Controller;

use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function cart(SessionInterface $session,
    EntityManagerInterface $manager)
    {
        $panier= $session->get('panier', []);
        $panierVu=[];
        foreach($panier as $id=>$quantite) {
            $panierVu[]=[
                'produit' =>$manager->getRepository(Products::class)->find($id),
                'quantite' =>$quantite
            ];
        }
        $montant=0;
        foreach($panierVu as $item) {
            $montant+=$item['produit']->getPriceTtc()* $item['quantite'];
        }
        return $this->render('cart/index.html.twig', [
            'Montant' => $montant,
            'panier'=> $panierVu
        ]);
    }
    /**
     * @Route("/cart_Add/{id}", name="cart_Add")
     */
    public function cart_Add($id, SessionInterface $session)
    {
        $panier = $session->get('panier',[]);
        if (empty($panier[$id])){
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        };
        $session->set('panier', $panier);

        return $this->redirectToRoute('cart');
    }
}

