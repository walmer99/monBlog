<?php
// src/Controller/BlogController.php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Article;
use App\Form\ArticleSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * Show all row from article's entity
     *
     * @Route("/blog/index", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        $form = $this->createForm(
            ArticleSearchType::class,
            null,
            ['method' => Request::METHOD_GET]
        );

        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles,
                'form' => $form->createView()]
        );
    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/blog/show/{slug}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     *  @return Response A response instance
     */
    public function show(?string $slug) : Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with '.$slug.' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/show.html.twig',
            ['article' => $article,
                'slug' => $slug,
            ]
        );
    }

    /**
     * @route("/blog/categoryParam/{name}",name="show_category")
     * @return Response A response instance
     */
    public function showByCategory(Category $category):Response
    {
       $articles=$category->getArticles();

        return $this->render('blog/categoryParam.html.twig',
            ['articles'=>$articles
                ]);
    }

    /**
     * @Route("/blog/test", name="test")
     */
    public function test()
    {
        return $this->render('blog/test.html.twig', ['test' => "test"
        ] );
    }
}
