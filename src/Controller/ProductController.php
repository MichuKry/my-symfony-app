<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductController extends AbstractController
{
    // --- 1. DODAWANIE PRODUKTU ---
    #[Route('/admin/product/new', name: 'app_product_new')]
    public function create(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $product = new Product();
        return $this->handleProductForm($product, $request, $entityManager, $slugger, 'product/create.html.twig');
    }

    // --- 2. EDYCJA PRODUKTU (TEGO BRAKOWAŁO!) ---
    #[Route('/admin/product/{id}/edit', name: 'app_product_edit')]
    public function edit(Product $product, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // Używamy tego samego formularza, ale przekazujemy istniejący produkt
        return $this->handleProductForm($product, $request, $entityManager, $slugger, 'product/edit.html.twig');
    }

    // --- WSPÓLNA METODA DO OBSŁUGI FORMULARZA (żeby nie kopiować kodu) ---
    private function handleProductForm(Product $product, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, string $template): Response
    {
        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class, ['label' => 'Nazwa produktu', 'attr' => ['class' => 'form-control']])
            ->add('description', TextareaType::class, ['label' => 'Opis', 'attr' => ['class' => 'form-control']])
            ->add('price', IntegerType::class, ['label' => 'Cena (w groszach)', 'attr' => ['class' => 'form-control']])
            ->add('imageFile', FileType::class, [
                'label' => 'Zdjęcie (JPG/PNG)',
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('save', SubmitType::class, ['label' => 'Zapisz', 'attr' => ['class' => 'btn-save']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads/products',
                        $newFilename
                    );
                    $product->setImageFilename('/uploads/products/'.$newFilename);
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Błąd wgrywania zdjęcia.');
                }
            }

            if (!$product->getId()) {
                $product->setCreatedAt(new \DateTimeImmutable());
                $entityManager->persist($product);
            }
            
            $entityManager->flush();
            $this->addFlash('success', 'Zapisano zmiany!');

            return $this->redirectToRoute('app_products_list');
        }

        return $this->render($template, [
            'form' => $form->createView(),
            'product' => $product
        ]);
    }

    // --- 3. LISTA PRODUKTÓW ---
    #[Route('/products', name: 'app_products_list')]
    public function list(ProductRepository $productRepository, Request $request): Response
    {
        $query = $request->query->get('q');
        if ($query) {
            $products = $productRepository->searchByQuery($query);
        } else {
            $products = $productRepository->findBy([], ['createdAt' => 'DESC']);
        }

        return $this->render('product/list.html.twig', [
            'products' => $products,
            'searchQuery' => $query
        ]);
    }

    // --- 4. API ---
    #[Route('/api/products', name: 'api_products', methods: ['GET'])]
    public function index(ProductRepository $productRepository): JsonResponse
    {
        return $this->json($productRepository->findAll());
    }
}