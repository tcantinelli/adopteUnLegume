<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Products;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

    //Products
        //Nom
        $listNames = ["Asperges Vertes","Avocats","Concombres","Endives","Poireaux","Poivrons","Carottes","Navet","Radis","Butternut","Salade","Tomate"];

        //Image
        $listImages = ["Asperges.jpg","Avocats.jpg","Concombres.jpg","Endives.jpg","Poireaux.jpg","Poivrons.jpg","Carottes.jpg","Navet.jpg","Radis.jpg","Butternut.jpg","Salade.jpg","Tomate.jpg"];

        //Description
        $listDescriptions = [
            "Plus ferme que l’asperge blanche et d’une saveur prononcée, elle se prête aussi bien aux recettes traditionnelles qu’à une cuisine inventive et original",
            "Très nourrissant et énergétique, l’avocat est un fruit aux grandes vertus tant gustatives que diététiques.",
            "Sa richesse en eau fait du concombre un légume particulièrement rafraichissant.",
            "Il est agréable de pouvoir en plein hiver croquer dans une plante en bourgeon.",
            "Bien qu’on l’ait surnommé « l’asperge du pauvre », le poireau mérite d’être mis à l’honneur pour ses propres qualités tant gustatives que nutritionnelles.",
            "Le légume idéal pour pimenter en douceur vos salades et plats cuisinés.",
            "Indispensables en cuisine pour mitonner vos petits plats, les carottes méritent leur place en toute saison dans votre panier de légumes.",
            "La saveur douce, très caractéristique, du navet se marie agréablement avec une multitude d’ingrédients.",
            "Délicieusement croquant, le radis rose est idéal à déguster en début de repas, tout simplement accompagné d’un peu de beurre et de sel.",
            "La Courge, comme l'ensemble des cucurbita, présente de nombreux atouts pour la santé.",
            "Sa texture est attrayante et son goût si particulier apporte quelque chose de nouveau.",
            "Cette variété bien en chair aux courbes généreuses est une référence dans l’univers de la tomate."
        ];

        //Prix
        $listPrix = [5.99,1.81,1.37,3.52,0.66,0.74,0.44,1.21,1.45,6.86,1.7,2.95];

        //Creation
        for($i = 0 ; $i < count($listNames) ; $i++){
            $product = new Products();
            $product->setNom($listNames[$i])
                ->setImage($listImages[$i])
                ->setDescription($listDescriptions[$i])
                ->setPrix($listPrix[$i]);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
