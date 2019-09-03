<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $productRepository)
    {
        $bestProducts = $productRepository->findBestProducts();
        
        dump($bestProducts);
        return $this->render('home/home.html.twig', [
            'bestProducts' => $bestProducts,
        ]);
    }
}
