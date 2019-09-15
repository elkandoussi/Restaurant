<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Panier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
       $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        $client = new Client();
        $client->setFirstname('messaoud');
        $client->setLastname('client1');
        $client->setEmail('oo@gmail.com');
        $client->setPassword('123');
        $client->setRoles(['ROLE_USER']);

        $encoded = $this->encoder->encodePassword($client, $client->getPassword());
        $client->setPassword($encoded);

        $panier = new Panier();
        $panier->setTotal(0);
        $client->setPanier($panier);

        $manager->persist($client);
        $manager->flush();
    }
}
