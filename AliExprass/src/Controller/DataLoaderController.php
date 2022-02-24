<?php

namespace App\Controller;

use DateTime;
use App\Entity\Product;
use App\Entity\Categories;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DataLoaderController extends AbstractController
{
    /**
     * @Route("/data", name="data_loader")
     */
    public function index(EntityManagerInterface $manager): Response //le manager permet de sauvegarder une entité en BD
    {
        $file_products = dirname(dirname(__DIR__)) . "\products.json"; // nous avons reculer de deux dossier pour arriver a produits.json
        $file_categories = dirname(dirname(__DIR__)) . "\categories.json";
        $data_products = json_decode(file_get_contents($file_products))[0]->rows; //la lecture du fichier  produits.json et json_decode() permet de transformer le fichier json en HTML
        $data_categories = json_decode(file_get_contents($file_categories))[0]->rows;
        $categories = [];
        $produts = [];
        foreach ($data_categories as $data_category) {
            $category = new Categories(); // creation d'object Metie
            $category->setName($data_category[1])
                ->setImage($data_category[3]);
            $manager->persist($category); // Persistance 
            $categories[] = $category; //sauvegarde
        }
        foreach ($data_products as $data_Product) {
            $product = new Product();
            $product->setName($data_Product[1])
                ->setDescription($data_Product[2])
                ->setPrice($data_Product[4])
                ->setIsBestSeller($data_Product[5])
                ->setIsNewArrival($data_Product[6])
                ->setIsFeatured($data_Product[7])
                ->setIsSpecialOffer($data_Product[8])
                ->setImage($data_Product[9])
                ->setQuantity($data_Product[10])
                ->setTags($data_Product[12])
                ->setSlug($data_Product[13])
                ->setCreatedAt(new \DateTime());

            $manager->persist($product); //Persistance 
            $produts[] = $product; // sauvegarde
        }

        //$manager->flush(); //l'envois en BD

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DataLoaderController.php',
        ]);
    }
}
