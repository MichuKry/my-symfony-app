<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductApiTest extends WebTestCase
{
    public function testProductsPageIsSuccessful(): void
    {
       
        $client = static::createClient();

        
        $client->request('GET', '/api/products');

        
        $this->assertResponseIsSuccessful();
 
        
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
    }
}