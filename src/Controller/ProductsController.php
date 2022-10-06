<?php

namespace App\Controller;

use App\Classes\ProductsClass;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{

    #[Route('/nos-produits', name: 'products')]
    public function index(ProductsClass $products): Response
    {
        return $this->render('products/index.html.twig', [
            'products' => $products->productList()
        ]);
    }
}
