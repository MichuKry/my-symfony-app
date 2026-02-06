<?php

namespace App\Tests;

use App\Entity\Product;
use App\Repository\ProductRepository;
use PHPUnit\Framework\TestCase;

class MockProductTest extends TestCase
{
    public function testGetLastProductWithMock(): void
    {
        
        $productRepository = $this->createMock(ProductRepository::class);

        
        $fakeProduct = new Product();
        $fakeProduct->setName('Udawany Olej');

       
        $productRepository->expects($this->once())
            ->method('getLastProduct')
            ->willReturn($fakeProduct);

       
        $result = $productRepository->getLastProduct();

        
        $this->assertEquals('Udawany Olej', $result->getName());
    }
}