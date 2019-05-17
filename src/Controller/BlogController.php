<?php
// src/Controller/BlogController.php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/list", name="blog_list")
     */
    public function list()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Walmer',
            'mdp'=> urlencode('Aphroditesçç')
        ]);
    }

    /**
     * @Route("/blog/show/{slug}", name="show",
     *     defaults={"slug"="Article Sans Titre"},
     *     requirements={"slug"="[a-z0-9-]+"})
     */

    public function show($slug)
    {

        $slug=str_replace( "-", " " , $slug);
        $slug = ucwords ($slug);
        return  $this->render('blog/show.html.twig',['slug' => $slug ]);

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
