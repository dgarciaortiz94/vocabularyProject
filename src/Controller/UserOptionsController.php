<?php

namespace App\Controller;

use App\Entity\UserOptions;
use App\Form\UserOptionsType;
use App\Repository\UserOptionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/options")
 */
class UserOptionsController extends AbstractController
{
    /**
     * @Route("/", name="user_options_index", methods={"GET"})
     */
    public function index(UserOptionsRepository $userOptionsRepository): Response
    {
        return $this->render('user_options/index.html.twig', [
            'user_options' => $userOptionsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_options_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userOption = new UserOptions();
        $form = $this->createForm(UserOptionsType::class, $userOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($userOption);
            $entityManager->flush();

            return $this->redirectToRoute('user_options_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_options/new.html.twig', [
            'user_option' => $userOption,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="user_options_show", methods={"GET"})
     */
    public function show(UserOptions $userOption): Response
    {
        return $this->render('user_options/show.html.twig', [
            'user_option' => $userOption,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_options_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, UserOptions $userOption, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserOptionsType::class, $userOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('user_options_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_options/edit.html.twig', [
            'user_option' => $userOption,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="user_options_delete", methods={"POST"})
     */
    public function delete(Request $request, UserOptions $userOption, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userOption->getId(), $request->request->get('_token'))) {
            $entityManager->remove($userOption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_options_index', [], Response::HTTP_SEE_OTHER);
    }
}
