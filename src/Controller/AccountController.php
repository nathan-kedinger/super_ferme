<?php

namespace App\Controller;

use App\Classes\Cart;
use App\Classes\ProductsClass;
use App\Entity\Products;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{

    public function __construct(EntityManagerInterface $em, RequestStack $stack){
        $this->em = $em;
        $this->stack = $stack;
    }

    #[Route('/compte', name: 'account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            
        ]);
    }
    /**
     * Undocumented function
     *
     * @param ProductsClass $productsClass
     * @return Response
     */
     #[Route('/compte/paniers', name: 'paniers')]
    public function booking(ProductsClass $productsClass): Response
    {
        $productsList = $productsClass->productList();


        return $this->render('account/booking.html.twig', [
            'products' => $productsList,
        ]);
    }
    
    /**
     * this function is a controller who permit to add product to the cart
     */
    #[Route('/compte/paniers/add/{id}', name: 'add_to_cart')]
    public function add(ProductsClass $productClass, int $id, User $user): Response
    {
        $productsList = $this->em->getRepository(Products::class)->findAll();

        $productClass->add($id, $user);
        


        return $this->render('account/booking.html.twig', [
            'products' => $productsList,
            
        ]); 
    }

    #[Route('/compte/paniers/remove/{id}', name: 'remove_to_cart')]
    public function remove(ProductsClass $productClass, int $id, User $user): Response
    {
        $productsList = $this->em->getRepository(Products::class)->findAll();

        $productClass->remove($id, $user);
        


        return $this->render('account/booking.html.twig', [
            'products' => $productsList,
            
        ]); 
    }



    /*#[Route('/nos-produits', name: 'app_products')]
    public function show(): Response
    {
        $products =$this->em->getRepository(Products::class)->findAll();

        return $this->render('account/booking.html.twig', [
            'products' => $products
        ]);
    }*/

}

