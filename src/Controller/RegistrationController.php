<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class, ['label' => 'Adres Email', 'attr' => ['class' => 'form-control']])
            ->add('firstName', TextType::class, ['label' => 'Imię', 'attr' => ['class' => 'form-control']])
            ->add('lastName', TextType::class, ['label' => 'Nazwisko', 'attr' => ['class' => 'form-control']])
            ->add('plainPassword', PasswordType::class, ['mapped' => false, 'label' => 'Hasło', 'attr' => ['class' => 'form-control']])
            ->add('save', SubmitType::class, ['label' => 'Zarejestruj się', 'attr' => ['class' => 'btn-buy']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_USER']);
            $entityManager->persist($user);
            $entityManager->flush();

            // TO JEST NOWA LINIA: Komunikat sukcesu
            $this->addFlash('success', 'Rejestracja udana! Możesz się teraz zalogować.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/index.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}