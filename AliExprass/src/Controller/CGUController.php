<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// Ajouter on veut que tout sois dans cgu 
/**
 * @Route("/cgu")
 */
class CGUController extends AbstractController
{
    /**
     * @Route("/conditions-general-utilisation", name="cgu_condition")
     */
    public function index(): Response
    {
        return $this->render('cgu/index.html.twig', [
            'controller_name' => 'CGUController',
        ]);
    }
}
