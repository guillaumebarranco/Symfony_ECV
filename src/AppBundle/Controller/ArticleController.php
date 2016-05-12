<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Articles;
use AppBundle\Form\Type\ArticlesType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller {

    function em() {
        return $this->getDoctrine()->getManager();
    }

    public function listAction() {

        $articles = $this->getDoctrine()
            ->getRepository('AppBundle:Articles')
            ->findAll();

        return $this->render('article/list.html.twig', [
            'articles' => $articles,
        ]);
    }

    public function viewAction(Request $request, Articles $article) {

        return $this->render('article/view.html.twig', [
            'article' => $article
        ]);
    }

    public function removeAction(Request $request, Articles $article) {
        $this->em()->remove($article);
        $this->em()->flush();

        $this->addFlash('success', 'Article supprimé !');

        return $this->redirectToRoute('article_list');
    }

    public function newAction(Request $request) {

        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->add('submit', SubmitType::class);

        if (isset($request) && $form->handleRequest($request)->isValid()) {

            $author = $this->getDoctrine()->getRepository('AppBundle:User')->find(1);

            $article->setAuthor($author);
            $article->setCreatedAt();
            $article->setUpdatedAt();
            $article->setSlug($article->getTitle());

            $this->em()->persist($article);
            $this->em()->flush();

            $this->addFlash('success', 'Article créé !');

            return $this->redirectToRoute('article_list');
        }

        return $this->render('article/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function editAction(Request $request, Articles $article) {

        $form = $this->createForm(ArticlesType::class, $article);
        $form->add('submit', SubmitType::class);

        if ($form->handleRequest($request)->isValid()) {

            $article->setSlug($article->getTitle());
            $article->setUpdatedAt();
            $this->em()->flush();

            $this->addFlash('success', 'Article édité !');

            return $this->redirectToRoute('article_edit', [
                'id' => $article->getId(),
            ]);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }
}
