<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route;


class TaskController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage" )
     */
    public function homepage()
    {
        $tasks = [
            [1, 'I ate a normal rock once. It did NOT taste like bacon!','danger', 'open'],
            [2, 'Woohoo! I\'m going on an all-asteroid diet!', 'primary', 'open'],
            [3, 'I like bacon too! Buy some from my site! bakinsomebacon.com','primary', 'done'],
        ];


        //return new Response($msg);
        return $this->render('task/index.html.twig', ['tasks' => $tasks]);
    }



    /**
     * @Route("/tasks/", name="app_homepage" )
     */
    public function task()
    {
        return $this->homepage();
    }

    /**
     * @Route("/show/{slug}", name="app_show_task")
     */
    public function show($slug)
    {
        //return new Response(sprintf("Show task number %s",$slug));

        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        $author = "Oussama";
        $created_at = "Septembre 24, 2018";
        return $this->render('task/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'author' => $author,
            'created_at' => $created_at,
            'comments' => $comments,
            'slug' => $slug
        ]);
    }

    /**
     * @Route("/done", name="app_done_list" )
     */
    public function done()
    {
        $tasks = [
            ['I ate a normal rock once. It did NOT taste like bacon!','danger'],
            ['Woohoo! I\'m going on an all-asteroid diet!', 'primary'],
            ['I like bacon too! Buy some from my site! bakinsomebacon.com','primary'],
        ];


        //return new Response($msg);
        return $this->render('task/done.html.twig', ['tasks' => $tasks]);
    }

    /**
     * @Route("/show/{slug}/heart", name="app_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug){
        //TODO : Actually like/unlike the article !
        return new JsonResponse(['hearts' => rand(0, 100)]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(){
        return $this->render('login.html.twig');
    }


    /**
     * @Route("/login", name="app_login")
     */
    public function login(){
        //TODO if the login and password are correct
        return $this->task();
    }
}