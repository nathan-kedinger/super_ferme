<?php
namespace App\Classes;

use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{
    private $stack;
    private $em;
    
    public function __construct(RequestStack $stack, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->stack = $stack;
    }

    public function add($id)
    {
        $session = $this->stack->getSession();
        $cart = $session->get('cart', []);

        if (!empty ($cart[$id])){
            $cart[$id]++;

        } else {
            //$cart[$id] = 1;
        }

        $session->set('cart', $cart);
    }
    public function get()
    {
        $methodGet = $this->stack->getSession();
        
        return $methodGet->get('cart');
    }
    
    public function remove ()
    {
        return $this->session->remove('cart');
    }

    public function delete($id)
    {
        $session = $this->stack->getSession();

        $cart = $session->get('cart', []);

        unset($cart[$id]);
        
        return $session->set('cart', $cart);
    }
    
    public function decrease($id)
    {
        $session = $this->stack->getSession();
        $cart = $session->get('cart', []);

        if ($cart[$id] > 1){
            $cart[$id] --;
        } else {
            unset($cart[$id]);
        }
        return $session->set('cart', $cart);
        
    }

    public function getFull()
    {
        $cartComplete = [];

        if ($this->get()){

            foreach ($this->get() as $id => $quantity){
                $product_object = $this->em->getRepository(Products::class)->findOneById($id);
                
                if(!$product_object){
                    $this->delete($id);
                    continue;
                }
                
                $cartComplete[] = [
                    'product' => $product_object,
                    'quantity' => $quantity
                ];
            }
        }
        return $cartComplete;    
    }
}