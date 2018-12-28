<?php

namespace App\Tests\Functions;

use App\Functions\Panier;
use PHPUnit\Framework\TestCase;

class PanierTest extends TestCase
{
    public function testTotal(){

        //Panier test
        $panierTest = [
            ['quantite' => 5, 'prix' => 20.0],
            ['quantite' => 1, 'prix' => 43.5]
        ];

        //Test fonction
        $testresult = (new Panier())->total($panierTest);

        //Assert
        $this->assertEquals(143.5, $testresult);
    }
}