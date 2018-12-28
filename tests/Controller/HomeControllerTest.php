<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\HttpFoundation\Cookie;

class HomeControllerTest extends WebTestCase
{
    public function testResponseHomePage(){

        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowNumberProductsHomePage(){

        //Creation panier virtuel
        $panier = [
            ['quantite' => 3]
        ];

        //Creation client
        $client = static::createClient();

        //Ajout panier en session
        $session = $client->getContainer()->get('session');
        $session->set('panier', $panier);

        //Requete
        $crawler = $client->request('GET', '/');

        //Test
        $this->assertEquals(
            3,
            $crawler = $crawler->filter('#compteur')->text()
        );
        
    }
}