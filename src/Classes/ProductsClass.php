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

    public function add(int $id)
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

        $this->booking();
    }

    public function remove(int $id)
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
       
    }

    public function booking ()
    {   
       $user = $this->em->getUser();
       dd($user);

        //$user->$users->setBooked(true);

    }

    public function unbooking ()
    {
        $user= $this->user;

        $user->setBooked(false);

    }
}