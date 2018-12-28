<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Products;
use App\Functions\Panier;

class PanierController extends AbstractController{

    /**
     * AJOUT PANIER
     * 
     * @Route("/addpanier/{idProduct}", name="addPanier")
     */
    public function addPanier($idProduct){

        $session = new Session();
        
        //Recup du panier de la session, creation si n'existe pas
        if($session->get('panier') !== null) {
            $panierEnCours = $session->get('panier');
        }else{
            $panierEnCours = [];
        }
        
        //Check si article déjà dans panier
        $flag = true;
        for($i = 0 ; $i < count($panierEnCours) ; $i++){
            if($idProduct == $panierEnCours[$i]['id']){
                $panierEnCours[$i]['quantite'] = $panierEnCours[$i]['quantite'] + $_POST['quantite'];
                $flag = false;
                break;
            }
        }

        //Si article pas present, ajout
        if($flag){
            //Recup infos produit
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository(Products::class)->find($idProduct);
    
            //Creation de l'article du panier
            $newArticle = [
                "id" => $product->getId(),
                "nom" => $product->getNom(),
                "description" => $product->getDescription(),
                "prix" => $product->getPrix(),
                "quantite" => $_POST['quantite']
            ];
            //Ajout de l'article
            array_push($panierEnCours,$newArticle);
        }

        //Update de la session
        $session->set('panier',$panierEnCours);

        //Retourne page precedente
        return $this->redirectToRoute('details',array('idProduit' => $idProduct));
    }

    /**
     * SUPPRESSION PANIER
     * 
     * @Route("/clear", name="clearPanier")
     */
    public function clearPanier(SessionInterface $session){
        
        $session->clear();

        return $this->redirectToRoute('home');

    }

    /**
     * SUPPRESSION ARTICLE
     * 
     * @Route("/remove/{idProduct}", name="removeArticle")
     */
    public function removeArticle($idProduct){

        $session = new Session();
       
        //Recuperation du panier de la session
        $panierEnCours = $session->get('panier');

        //suppresion article
        for($i = 0 ; $i < count($panierEnCours) ; $i++){
            if($idProduct == $panierEnCours[$i]['id']){
                array_splice($panierEnCours, $i, 1);
                break;
            }
        }

        //Update de la session
        $session->set('panier',$panierEnCours);

        //Retourne page precedente
        return $this->redirectToRoute('panier');
    }

     /**
      * AFFICHAGE DETAILS PANIER
     * @Route("/panier", name="panier")
     */
    
    public function index(){

        $session = new Session();
       
        //Recuperation panier
        $panier = $session->get('panier');

        //Nb articles
        $nbArticles = (new Panier())->getNbArticles($panier);

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
            'nbArticles' => $nbArticles
        ]);
    }

    /**
     * UPDATE PANIER
     * 
     * @Route("/update", name="updatePanier")
     */
    public function updatePanier(){

        $session = new Session();
       
        //Recuperation du panier de la session
        $panierEnCours = $session->get('panier');

        //Mise à jour article
        for($i = 0 ; $i < count($panierEnCours) ; $i++){
            if($_POST['id'] == $panierEnCours[$i]['id']){
                $panierEnCours[$i]['quantite'] = $_POST['quantite'];
                break;
            }
        }

        //Update de la session
        $session->set('panier',$panierEnCours);

        //Retourne page precedente
        return $this->redirectToRoute('panier');
    }

}
   

