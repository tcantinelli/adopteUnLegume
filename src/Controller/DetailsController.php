<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Products;
use App\Functions\Panier;

class DetailsController extends AbstractController
{
    /**
     * @Route("/details/{idProduit}", name="details")
     */
    public function index($idProduit,SessionInterface $session){

        //Recuperation panier
        $panier = $session->get('panier');

        //Nb articles
        $nbArticles = (new Panier())->getNbArticles($panier);

        //Entity manager
        $em = $this->getDoctrine()->getManager();

        //Recup produit
        $product = $em->getRepository(Products::class)->find($idProduit);

        return $this->render('details/index.html.twig', [
            'product' => $product,
            'nbArticles' => $nbArticles
        ]);
    }
}
