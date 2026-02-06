<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Nazwa, Opis, Cena (grosze), URL do obrazka
        $productsData = [
            ['Olej Silnikowy 5W-30', 'Syntetyczny olej najwyższej jakości', 12000, 'https://placehold.co/300x200/png?text=Olej+5W30'],
            ['Opony Zimowe Dębica', 'Komplet opon zimowych 15 cali', 120000, 'https://placehold.co/300x200/png?text=Opony'],
            ['Płyn do spryskiwaczy', 'Zimowy płyn -22C, zapach cytrynowy', 2500, 'https://placehold.co/300x200/png?text=Plyn'],
            ['Wycieraczki Bosch', 'Pióra wycieraczek Aerotwin', 8000, 'https://placehold.co/300x200/png?text=Wycieraczki'],
            ['Akumulator 74Ah', 'Mocny akumulator do diesla', 45000, 'https://placehold.co/300x200/png?text=Akumulator'],
            ['Klucz do kół', 'Solidny klucz krzyżakowy', 3500, 'https://placehold.co/300x200/png?text=Klucz'],
            ['Apteczka samochodowa', 'Zgodna z normą DIN', 4000, 'https://placehold.co/300x200/png?text=Apteczka'],
            ['Olej 10W-40', 'Półsyntetyk do starszych silników', 11000, 'https://placehold.co/300x200/png?text=Olej+10W40'],
            ['Filtr powietrza', 'Sportowy filtr stożkowy', 9000, 'https://placehold.co/300x200/png?text=Filtr'],
            ['Żarówki H7', 'Zestaw żarówek Premium Vision', 5500, 'https://placehold.co/300x200/png?text=Zarowki+H7'],
        ];

        foreach ($productsData as $data) {
            $product = new Product();
            $product->setName($data[0]);
            $product->setDescription($data[1]);
            $product->setPrice($data[2]);
            $product->setImageFilename($data[3]); // Zapisujemy URL obrazka
            $product->setCreatedAt(new \DateTimeImmutable());
            
            $manager->persist($product);
        }

        $manager->flush();
    }
}