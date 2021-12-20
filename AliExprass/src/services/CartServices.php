<?php

namespace App\services;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartServices
{
    private $session;
    private $repoProduct;
    public function __construct(SessionInterface $session, ProductRepository $repoProduct)
    { // Creation de l'objet sesion

        $this->session = $session; //affectation de la session
        $this->repoProduct = $repoProduct; // affection de repository

    }

    public function addtoCart($id)
    {
        $cart = $this->getCart(); //Rrecuperation de la session
        if (isset($cart[$id])) {
            // Le produit est dans le paniel
            $cart[$id]++;
        } else {
            // Le produit n'est pas dans le panier
            $cart[$id] = 1;
        }
        $this->updatCart($cart); // Mise a jours lors de l'ajout ou du supression du produit 
    }

    public function deleteFromcart($id) // suppresion d'une commande
    {
        $cart = $this->getCart();
        if (isset($cart[$id])) {
            //Produit déja dans le Panier
            if ($cart[$id] > 1) {
                // Produit n'esxiste plus d'une fois
                $cart[$id]--;
            } else {
                unset($cart[$id]);
            }
            $this->updatCart($cart); // Mise a jours lors de l'ajout ou du supression du produit
        }
    }

    public function deleteCart() // Suppression de toute les commandes des produit 
    {
        $this->updatCart([]); // Mise a jours lors de l'ajout ou du supression de la commande du produit
    }

    public function deleteAllCart($id)
    {
        $cart = $this->getCart();
        if (isset($cart[$id])) {
            //Produit déja dans le Panier
            unset($cart[$id]);
            $this->updatCart($cart); // Mise a jours lors de l'ajout ou du supression du produit
        }
    }
    public function updatCart($cart)
    {
        $this->session->set('cart', $cart);
    }

    public function getCart() // Retoure l'information du panier
    {
        return $this->session->get('cart', []); // Retourn un information ou vide si l'information n'y est pas 
    }

    // Recuperation de tout le panier
    public function getfullCart()
    {
        $cart = $this->getCart();
        $fullCart = [];
        foreach ($cart as $id => $quantity) {
            $product = $this->repoProduct->find($id); // On recuper les info de la table produit vias son repository
            if ($product) { // Affectation au tableau $fullCart[] s'ils sont
                $fullCart[] = [
                    "quantity" => $quantity,
                    "produit" => $product
                ];
            } else { //Id Incorect
                $this->deleteFromcart($id);
            }
        }
        return $fullCart;
    }
}
