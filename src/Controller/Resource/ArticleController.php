<?php

namespace App\Controller\Resource;

use App\Entity\Article\Article;
use App\Form\Type\Article\ArticleType;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends ResourceController
{
    public function addAction(Request $request): Response
    {
        $form = $this->createForm(ArticleType::class, new Article());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Article $post */
            $post = $form->getData();

            $this->repository->add($post);

            // Add a flash
            $this->addFlash('success', 'Your post have been added!');

            // Redirect
            return $this->redirectToRoute('app_backend_article_index');
        }

        return $this->render(
            'backend/article/testAdd.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
