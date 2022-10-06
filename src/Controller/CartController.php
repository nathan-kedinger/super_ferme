<?php

namespace App\Controller;

use App\Classes\Cart;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/reservations/loupe', name: 'account_book')]
    public function index(Cart $cart): Response
    {

        return $this->render('account/booking.html.twig', [
            'cart' => $cart->getFull()
        ]);
    } 
    
























    
    #[Route('/cart/remove', name: 'remove_my_cart')]
    public function remove (Cart $cart): Response
    {
        $cart->remove();

        return $this->redirectToRoute('products');
    }

    #[Route('/cart/delete{id}', name: 'delete_to_cart')]
    public function delete (Cart $cart, $id): Response
    {
        $cart->delete($id);

        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/decrease{id}', name: 'decrease_to_cart')]
    public function decrease (Cart $cart, $id): Response
    {
        $cart->decrease($id);

        return $this->redirectToRoute('cart');
    }
}
