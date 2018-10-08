<?php

namespace App\Controller;

use App\Entity\Task;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route;


class TaskController extends AbstractController
{

    /**
     * @Route("/", name="homepage" )
     */
    public function homepage()
    {
        $tasks = $this->getDoctrine()
                ->getRepository(Task::class)
                ->findAll();


        /*$tasks = [
            [1, 'I ate a normal rock once. It did NOT taste like bacon!', 'danger', 'open'],
            [2, 'Woohoo! I\'m going on an all-asteroid diet!', 'primary', 'open'],
            [3, 'I like bacon too! Buy some from my site! bakinsomebacon.com', 'primary', 'done'],
        ];*/


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
     * @Route("/show/{id}", name="app_show_task")
     */
    public function show($id)
    {

        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);
        //return new Response(sprintf("Show task number %s",$slug));

        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        $author = "Oussama";
        //$createTime = DateTime::createFromFormat("l dS F Y", $task->getCreateTime());
        return $this->render('task/show.html.twig', ['task' => $task]);

        /*[
            'title' => ucwords(str_replace('-', ' ', $task->getTitle())),
            'description' => $task->getDescription(),
            'author' => $author,
            'created_at' => $task->getCreateTime(),
            'deadline' => $task->getDeadline(),
            'comments' => $comments,
            'id' => $id
        ]);*/
    }

    /**
     * @Route("/done", name="app_done_list" )
     */
    public function done()
    {
        $tasks = [
            ['I ate a normal rock once. It did NOT taste like bacon!', 'danger'],
            ['Woohoo! I\'m going on an all-asteroid diet!', 'primary'],
            ['I like bacon too! Buy some from my site! bakinsomebacon.com', 'primary'],
        ];


        //return new Response($msg);
        return $this->render('task/done.html.twig', ['tasks' => $tasks]);
    }

    /**
     * @Route("/show/{id}/heart", name="app_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($id)
    {
        //TODO : Actually like/unlike the article !
        return new JsonResponse(['hearts' => rand(0, 100)]);
    }

    /**
     * @Route("/new", name="app_new_task", methods={"POST", "GET"})
     */
    public function new(Request $request)
    {
        $task = new Task();
        $form = $this->createFormBuilder($task)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('deadline', DateTimeType::class, array('required'  => false, 'attr' => array('class' => 'form-control')))
            ->add('priority', ChoiceType::class, array('required'  => false, 'choices'=>array('High'=>'High', 'Normal'=>'Normal', 'Low'=>'Low'),  'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Save', 'attr' => array('class' => 'btn btn-sm mt-3')))
            ->getForm();

        return $this->render('new.html.twig', ['form' => $form->createView()]);
    }




    /**
     * @Route("/login", name="app_login", methods={"POST", "GET"})

    public function login()
    {
        if (count($_POST) != 0 && $_POST['email'] == "admin@admin.com" && $_POST["password"] == "admin")
            return $this->task();
        else
            return $this->render('login.html.twig');

    }*/

    /**
     * @Route("/save")
     */
    public function save()
    {
        $em = $this->getDoctrine()->getManager();
        $task = new Task();
        $task->setTitle("New task 1")
            ->setDescription("Hello new task 1")
            ->setStatus("open")
            ->setPriority("normal")
            ->setCreateTime(new \DateTime('now'));

        $em->persist($task);
        $em->flush();

        return new Response("Saved task with id " . $task->getId());


    }

}