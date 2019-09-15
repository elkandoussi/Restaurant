<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="menu")
     */
    public function index(CategoryRepository $categoryRepository)
    {

        return $this->render('menu/menu.html.twig', []);
    }

    /**
     * @Route("/menu/{type}", name="show_products")
     */
    public function showProducts(CategoryRepository $categoryRepository, $type)
    {
       
        $products = $categoryRepository->findOneByName($type)->getProducts();
                
        $list =  array();
        
        foreach( $products as $product){
            array_push($list, $product->toArray());
        };
        
        $response = new Response(json_encode($list));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
}
