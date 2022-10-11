<?php
namespace App\Classes;

use App\Entity\Products;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
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
        
        $productName = $product->getName();
        
        $availableProducts = $product->getAvailableQuantity();
        $availableProducts--;

        $bookedProducts = $product->getBookedQuantity();
        $bookedProducts++;

        $product->setAvailableQuantity($availableProducts);
        $product->setBookedQuantity($bookedProducts);

        $this->em->persist($product);
        $this->em->flush();

        $this->booking($productName, $user);
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

        $this->unBooking($user);

       
    }

    public function booking ($productName, User $users)
    {   
        $users->setBooked(true);
        $users->setBookedPoduct($productName);
        $this->em->persist($users);
        $this->em->flush();


    }

    public function unbooking (User $users)
    {
        $users->setBooked(false);
        $users->setBookedPoduct(null);
        $this->em->persist($users);
        $this->em->flush();

    }
}