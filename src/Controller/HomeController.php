<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Products;
use App\Functions\Panier;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SessionInterface $session){

        //Recuperation panier
        $panier = $session->get('panier');

        //Nb articles
        $nbArticles = (new Panier())->getNbArticles($panier);

        //Entity manager
        $em = $this->getDoctrine()->getManager();

        //Liste des produits
        $products = $em->getRepository(Products::class)->findBy(array(),array('nom' => 'ASC'));

        return $this->render('home/index.html.twig', [
            'products' => $products,
            'nbArticles' => $nbArticles
        ]);
    }
}
