<?php


namespace App\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TagController
 * @package App\Controller
 * @Route("/blog/tag/{name}")
 */

class TagController extends AbstractController
{
/**
 * @Route
 */

public function index(): Response
{
    return $this->render('blog/tag.html.Twig',
        ['tag' => $tags],
        )
}
}