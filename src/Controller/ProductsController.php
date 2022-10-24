<?php

namespace App\Controller;

use App\Classes\ProductsClass;
use App\Classes\UniqProductsClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{

    #[Route('/nos-produits', name: 'products')]
    public function index(ProductsClass $products, UniqProductsClass $uniqProducts): Response
    {
        return $this->render('products/index.html.twig', [
            'products' => $products->productList(),
            'uniqProducts' => $uniqProducts->uniqProductList()
        ]);
    }
}
