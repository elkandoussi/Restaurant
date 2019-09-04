<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="menu")
     */
    public function index(CategoryRepository $categoryRepository)
    {
        $plats = $categoryRepository->findOneByName('Plat')->getProducts();
        $entrees = $categoryRepository->findOneByName('Entree')->getProducts();
        $desserts = $categoryRepository->findOneByName('Dessert')->getProducts();

        return $this->render('menu/menu.html.twig', [
            'plats' => $plats,
            'entrees' => $entrees,
            'desserts' => $desserts
        ]);
    }
}
