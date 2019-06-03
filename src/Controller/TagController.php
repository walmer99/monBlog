<?php


namespace App\Controller;

Use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
Use Symfony\Component\HttpFoundation\Response;
Use Symfony\Component\Routing\Annotation\Route;
Use App\Entity\Tag ;




class TagController extends AbstractController
{
/**
 * @Route("/blog/tag/{name}", name = "blog_tag")
 * @return Response
 */

public function showByTag (Tag $tag): Response
{
    $article = $tag->getArticles();
    return $this->render(
        'blog/tag.html.twig',
        ['articles' => $article, 'tag' => $tag]
    );
}
}