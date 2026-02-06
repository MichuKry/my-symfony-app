<?php

namespace App\Tests;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductInitialization(): void
    {
       
        $product = new Product();
        $product->setName('Testowy Olej');
        $product->setPrice(10000); // 100 PLN

        $this->assertEquals('Testowy Olej', $product->getName());
        $this->assertEquals(10000, $product->getPrice());
        $this->assertNotNull($product->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $product->getCreatedAt());
    }
}