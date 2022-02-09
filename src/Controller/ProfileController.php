<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{

    /**
     * @Route("/", name="profile")
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }


    /**
     * @Route("/security", name="profile.security", methods={"GET", "POST"})
     */
    public function security(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($request->isMethod('POST')) {
            $entityManager = $doctrine->getManager();

            $lastPass       = $request->get("last-pass");
            $newPass        = $request->get("new-pass");
            $repeatNewPass  = $request->get("repeat-new-pass");


            if ($newPass != $repeatNewPass) return new Response("La contraseñas no coinciden");

            if ($lastPass == $newPass) return new Response("La contraseñas no pueden ser iguales");

            if ($lastPass != $this->getUser()->getPassword()) return new Response("La contraseñas anterior no es correcta");


            $userRepository = $entityManager->getRepository(User::class);

            $user = $userRepository->findOneBy(["email" => $this->getUser()->getUserIdentifier()]);

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $newPass
            );

            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            return new Response("La contraseña fue cambiada satisfactoriamente");
        }

        return $this->render('profile/security.html.twig');
    }


    /**
     * @Route("/info", name="profile.info")
     */
    public function info(bool $edit = false): Response
    {
        return $this->render('profile/info.html.twig', [
            'controller_name' => 'ProfileController',
            'edit' => false
        ]);
    }
}
