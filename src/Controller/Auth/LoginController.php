<?php

namespace App\Controller\Auth;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class LoginController extends AbstractController
{
    private $title;

    public function __construct()
    {
        $this->title = 'Bienvenue sur la page de connexion';
    }

    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

    /**
     * @Route("/login", name="login",methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function login(Request $request, EntityManagerInterface $manager): Response
    {
        $req = $request->request;
        if ($req->count() > 0 && $req->get("username") !== null && $req->get("password") !== null) {
            $user = $manager->getRepository(User::class)->findOneBy($req->get("username"));

            if ($user !== null && password_verify($req->get("password"), $user->getPassword())) {
                $this->title = "Bienvenue" . $user->getUsername() . " sur la premiere page";
                $session = $this->get("session");
                $session->set('filter', array(
                    "idRole" => $user->getRole()->getId(),
                    "usernale" => $user->getRole()->getId(),
                    "idUser" => $user->getId()
                ));

                return $this->render('view/index.html.twig', ["title" => $this->title]);
            }
        }

        return $this->render('view/index.html.twig', ["title" => $this->title,"errorLogin"=>"Error Login/Password"]);
    }



}
