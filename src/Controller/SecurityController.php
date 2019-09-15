<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManager;
use App\Repository\ClientRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login_client")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        //récupérer les errors s'ils existent
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('security/login.html.twig', [
            'error' => $error,
            'lastUsername' => $lastUsername
        ]);
    }
    
    /**
     * @Route("/logout", name="logout_client")
     */
    public function logout(){
      
    }
    
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $req, UserPasswordEncoderInterface $encoder){
        $client = new Client();
        $form = $this->createForm(InscriptionType::class, $client);
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid() ){
            $client->setRoles(['ROLE_USER']);

            $encoded = $encoder->encodePassword($client, $client->getPassword());
            $client->setPassword($encoded);

              
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('login_client');
            dump($client);
        }

        return $this->render('security/inscription.html.twig',[
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/compte/{id}", name="compte")
     */
    public function showCompte($id, ClientRepository $clientRep){
       $client = $clientRep->find($id);

       $panier = $client->getPanier();

       return $this->render('security/compte.html.twig', [
           'client' => $client,
           'panier' => $panier
       ]);
    }

     /**
      * @Route("/check",name="check")
      */
    public function checkUser(){
        $user = $this->getUser();
        
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers,$encoders);

        $user = $serializer->serialize($user,'json');
     
        return  new Response($user, Response::HTTP_OK,[
            'content-type' => 'application/json'
        ]);
    }
}
