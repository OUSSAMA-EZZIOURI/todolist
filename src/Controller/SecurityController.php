<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="app_login", methods={"POST", "GET"})
     */
    //Request $request,
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();


        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
        ]);

        /*if (count($_POST) != 0 && $_POST['email'] == "admin@admin.com" && $_POST["password"] == "admin") {
            $task_c = new TaskController();
            return $task_c->task();
        }
        else
            return $this->render('login.html.twig');*/

    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {

        return $this->login();
    }
}
