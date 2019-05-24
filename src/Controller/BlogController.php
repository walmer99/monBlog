<?php
// src/Controller/BlogController.php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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


        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
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
     * @route("/blog/category/{categoryName}",name="show_category")
     * @return Response A response instance
     */
    public function showByCategory(string $categoryName):Response
    {
        $category=$this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);

//Récupère les 3 derniers articles de la classe
        //$categoryArticles=$this->getDoctrine()
           //->getRepository(Article::class)
            //->findBy(['Category' => $category],
                //['id'=>'DESC'], 3);

       $categoryArticles=$category->getArticles();

        return $this->render('blog/category.html.twig',
            ['categoryArticles'=>$categoryArticles, 'category'=>$category
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
