<?php
namespace App\Classes;

use App\Entity\Products;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class ProductsClass{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function productList(){

        $products =$this->em->getRepository(Products::class)->findAll();


        return $products;
    }

    public function add(int $id, UserInterface $user)
    {
        $product = $this->em->getRepository(Products::class)->findOneById($id);
        
        
        $availableProducts = $product->getAvailableQuantity();
        $availableProducts--;

        $bookedProducts = $product->getBookedQuantity();
        $bookedProducts++;

        $product->setAvailableQuantity($availableProducts);
        $product->setBookedQuantity($bookedProducts);

        $this->em->persist($product);
        $this->em->flush();

        $this->booking($id, $user);
    }

    public function remove(int $id, UserInterface $user)
    {
        $product = $this->em->getRepository(Products::class)->findOneById($id);
        $availableProducts = $product->getAvailableQuantity();
        $availableProducts++;

        $bookedProducts = $product->getBookedQuantity();
        $bookedProducts--;

        $product->setAvailableQuantity($availableProducts);
        $product->setBookedQuantity($bookedProducts);

        $this->em->persist($product);
        $this->em->flush();

        $this->unBooking($id, $user);

       
    }

    public function booking (int $id, User $user)
    {   
        $user->setBooked(true);
        $user->setBookedPoduct($id);
        $this->em->persist($user);
        $this->em->flush();


    }

    public function unbooking (int $id, User $user)
    {
        $user->setBooked(false);
        $user->setBookedPoduct($id);
        $this->em->persist($user);
        $this->em->flush();

    }
}