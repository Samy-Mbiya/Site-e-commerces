<?php

namespace App\Controller;

use App\Form\CheckoutType;
use App\services\CartServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    /**
     * @Route("/checkout", name="checkout")
     */
    public function index(CartServices $cartServices, Request $request): Response
    {
        $user = $this->getUser(); // Recuperation de l'utilisateur connecter
        $cart = $cartServices->getfullCart(); // recuperation de la methode getfullcart

        if (!$cart) { // si le cart est vide
            return $this->redirectToRoute("home");
        }

        if (!$user->getAddresses()->getValues()) { //s'il n'a pas d'adresse 
            $this->addFlash('checkout_message', 'Please add an adress to yur account without continuing !');
            return $this->redirectToRoute("address_new");
        }

        // Creation du Formulair
        //$form = $this->createForm(CheckoutType::class, null, ['user' => $user]); // le user specifier permet a checkoutType de recuper les info dans user
        // Analyser le formulaire
        //$form->handleRequest($request);
        //Traitement du formulaire 
        return $this->render('checkout/index.html.twig', [
            'cart' => $cart,

        ]);
    }
}
