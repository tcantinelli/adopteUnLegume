<?php

namespace App\Functions;

class Panier
{
    /**
     * Retourne le prix total d'un panier
     */
    public function total($panier){

        $total = 0;

        foreach($panier as $product){
            $total += $product['quantite'] * $product['prix'];
        }

        return $total;
    }

    /**
     * Retourne le nombre d'articles du panier
     */
    public function getNbArticles($panier){

        $nbArticles = 0;
            
        if($panier !== null) {
            foreach($panier as $article){
                $nbArticles += $article['quantite'];
            }
        }

        return $nbArticles;
    }
}