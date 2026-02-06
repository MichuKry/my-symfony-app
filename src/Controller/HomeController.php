<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // Symulacja bazy producentów
        $brands = [
            ['name' => 'Bosch', 'logo' => 'https://placehold.co/150x100/white/black?text=BOSCH'],
            ['name' => 'Castrol', 'logo' => 'https://placehold.co/150x100/white/green?text=Castrol'],
            ['name' => 'Brembo', 'logo' => 'https://placehold.co/150x100/white/red?text=Brembo'],
            ['name' => 'Michelin', 'logo' => 'https://placehold.co/150x100/white/blue?text=Michelin'],
            ['name' => 'Valeo', 'logo' => 'https://placehold.co/150x100/white/green?text=Valeo'],
            ['name' => 'Continental', 'logo' => 'https://placehold.co/150x100/white/orange?text=Continental'],
        ];

        return $this->render('home/index.html.twig', [
            'brands' => $brands
        ]);
    }
}