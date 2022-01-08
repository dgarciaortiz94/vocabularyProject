<?php

namespace App\Controller;

use App\Entity\Expression;
use App\Entity\Language;
use App\Form\ExpressionType;
use App\Repository\ExpressionRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expression")
 */
class ExpressionController extends AbstractController
{
    /**
     * @Route("/", name="expression_index", methods={"GET"})
     */
    public function index(ExpressionRepository $expressionRepository): Response
    {
        $allExpressions = $expressionRepository->findBy([], ["name" => "asc"]);

        return $this->render('expression/index.html.twig');
    }

    /**
     * @Route("/getAllExpressions", name="get_all_expressions", methods={"GET"})
     */
    public function getAllExpressions(ExpressionRepository $expressionRepository): Response
    {
        $allExpressions = $expressionRepository->findBy([], ["name" => "asc"]);

        return new JsonResponse([
            "success" => true, 
            "expressions" => $allExpressions
        ]);
    }

    /**
     * @Route("/new", name="expression_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $expression = new Expression();
        $expressionLanguage = $entityManager->getRepository(Language::class)->findOneBy(["code" => "es"]);
        $translationLanguage = $entityManager->getRepository(Language::class)->findOneBy(["code" => "en"]);

        $expression->setExpressionLanguage($expressionLanguage);
        $expression->setTranslationLanguage($translationLanguage);

        $form = $this->createForm(ExpressionType::class, $expression);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $expression->addUserId($this->getUser());
            $expression->setSearchDate(new DateTime());

            $entityManager->persist($expression);
            $entityManager->flush();

            return $this->redirectToRoute('expression_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('expression/new.html.twig', [
            'expression' => $expression,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="expression_show", methods={"GET"})
     */
    public function show(Expression $expression): Response
    {
        return $this->render('expression/show.html.twig', [
            'expression' => $expression,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="expression_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Expression $expression, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExpressionType::class, $expression);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('expression_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('expression/edit.html.twig', [
            'expression' => $expression,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="expression_delete", methods={"POST"})
     */
    public function delete(Request $request, Expression $expression, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$expression->getId(), $request->request->get('_token'))) {
            $entityManager->remove($expression);
            $entityManager->flush();
        }

        return $this->redirectToRoute('expression_index', [], Response::HTTP_SEE_OTHER);
    }
}
