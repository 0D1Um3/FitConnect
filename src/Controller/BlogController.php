<?php

namespace App\Controller;

//Импорт классов
use App\Repository\ArticlesRepository;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

class BlogController extends AbstractController
{
    //Маршрут для страницы блога
    #[Route('/blog', name: 'app_blog')]
    public function blog(Environment $twig, ArticlesRepository $articlesRepository): Response
    {
        //настройка вывода шаблона
        return new Response($twig->render('BlogPage/blog.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]));
    }
    //Маршрут для страницы статьи
    #[Route('/article/{id}', name: 'app_article')]
    public function article(Environment $twig, ArticlesRepository $articlesRepository, int $id, ImagesRepository $imagesRepository): Response
    {
        //Извлечение статей
        $article = $articlesRepository->find($id);
        if (!$article) {
            throw $this->createNotFoundException('The article does not exist');
        }

        // Декодируем HTML сущности текста статьи
        $decodedText = html_entity_decode($article->getText(), ENT_QUOTES | ENT_HTML5);

        //настройка вывода шаблона
        return new Response($twig->render('BlogPage/article.html.twig', [
            'article' => $article,
            'decodedText' => $decodedText,
            'images' => $imagesRepository->findBy(['articles' => $id]),
        ]));
    }

}
