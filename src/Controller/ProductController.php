<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/product/add', name: 'app_add_product')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        // dd($request);
    $product = new Produit();
    $form = $this ->createForm(ProductType::class,$product);
    $form->handleRequest($request);

    if($form->isSubmitted()&& $form->isValid()){
        $em->persist($product);
        $em->flush();

        return $this->redirectToRoute('app_product');
    }

        return $this->render('product/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
