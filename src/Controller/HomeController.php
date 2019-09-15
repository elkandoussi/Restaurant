<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    /**
     * @Route("/reservation", name="reservation")
     */
    public function book(){
        $reservation = new Reservation();

        $formBook = $this->createForm(ReservationType::class, $reservation);
       return $this->render('/home/reservation.html.twig', [
           'formBook' => $formBook->createView()
       ]);
    }
}
