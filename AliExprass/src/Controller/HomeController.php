<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $repoProduct): Response
    {
        $products = $repoProduct->findAll();
        $productBestSeller = $repoProduct->findByIsBestSeller(1);
        $productSpecialOffer = $repoProduct->findByIsSpecialOffer(1);
        $productNewArrival = $repoProduct->findByIsNewArrival(1);
        $productFeatured = $repoProduct->findByIsFeatured(1);
        // dd($productNewArrival);
        //dd($productBestSeller, $productSpecialOffer, $productNewArrival, $productFeatured, $productFeatured);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'products' => $products,
            'productBestSeller' => $productBestSeller,
            'productSpecialOffer' => $productSpecialOffer,
            'productNewArrival' => $productNewArrival,
            'productFeatured' => $productFeatured,
        ]);
    }


    //Affichage du Produit en detail
    /**
     * @Route ("/product/{slug}", name="product_details")
     */
    public function show(?Product $product): Response // Le ? veut dire qu'on peut ou ne pas avoir la valeur 
    {
        if (!$product) {
            return $this->redirectToRoute("home"); // Il n'y a pas de slug ou (Id) on se redirectionne vers la page home
        }
        return $this->render("home/single_product.html.twig", ['product' => $product]); // On renvois a la page single_product.html.twig avec le parametre du product
    }
}
