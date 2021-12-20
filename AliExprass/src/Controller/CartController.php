<?php

namespace App\Controller;

use App\services\CartServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(CartServices $cartServices): Response //Extention de l'objet $cartServices qui est dans la class CartServices 
    {
        $cartServices->addtoCart(3); // Recuperation de la methode addtoCart
        dd($cartServices->getCart()); // Recuperation de la methode getCart
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    /**
     * @Route("/cart/add/{id}")
     */

    public function addtoCart($id, CartServices $cartServices): Response // Ajout de Produit dans le pagnier
    {
        //$cartServices->deleteCart();
        $cartServices->addtoCart($id);
        dd($cartServices->getfullCart()); // Recuperation de la methode getCart
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    /**
     * @Route("/cart/delete/{id}")
     */

    public function deleteFromCart($id, CartServices $cartServices): Response // Suppression d'une commande du produit dans le panier
    {
        //$cartServices->deleteCart();
        $cartServices->deleteFromCart($id);
        dd($cartServices->getfullCart()); // Recuperation de la methode getCart
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
