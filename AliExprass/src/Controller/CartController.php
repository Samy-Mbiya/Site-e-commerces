<?php

namespace App\Controller;

use App\services\CartServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $cartServices;
    public function __construct(CartServices $cartServices)
    {
        $this->cartServices = $cartServices;
    }

    /**
     * @Route("/cart", name="cart")
     */
    public function index(): Response //Extention de l'objet $cartServices qui est dans la class CartServices 
    {
        $cart = $this->cartServices->getfullCart(); //Recuperation de la methode getfullCart()


        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'cart' => $cart,
        ]);
    }

    /**
     * @Route("/cart/add/{id}" , name="cart_add")
     */

    public function addtoCart($id, CartServices $cartServices): Response // Ajout de Produit dans le pagnier
    {
        $this->cartServices->addtoCart($id);
        return $this->redirectToRoute("cart"); // on redirige vers le la route cart
    }

    /**
     * @Route("/cart/delete/{id}", name="cart_delete")
     */

    public function deleteFromCart($id, CartServices $cartServices): Response // Suppression d'une commande du produit dans le panier
    {
        //$cartServices->deleteCart();
        $this->cartServices->deleteFromCart($id);
        return $this->redirectToRoute("cart"); // on redirige vers le la route cart
    }

    /**
     * @Route("/cart/deletetallcart/{id}", name="cart_deleteallcart")
     */

    public function deleteAllCart($id, CartServices $cartServices): Response // Suppression d'une commande du produit dans le panier
    {
        //$cartServices->deleteCart();
        $this->cartServices->deleteAllCart($id);
        return $this->redirectToRoute("cart"); // on redirige vers le la route cart
    }
}
