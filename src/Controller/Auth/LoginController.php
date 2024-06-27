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

    //#[Route('/login', name: 'app_login')]
    //public function index(): Response
    //{
    //    return $this->render('login/index.html.twig', [
    //        'controller_name' => 'LoginController',
    //    ]);
  //  }

    /**
     * @Route("/login", name="login",methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function login(Request $request, EntityManagerInterface $manager): Response
    {
       /* //dd($request);

        $req = $request->request;
        if ($req->count() > 0 && $req->get("username") !== null && $req->get("password") !== null) {
            $user = $manager->getRepository(User::class)->findOneByLowerUsername($req->get("username"));

            //dd($user);
            //dd(password_verify($req->get("password"), $user->getPassword()));

            if ($user !== null && password_verify($req->get("password"), $user->getPassword())) {
                $this->title = "Bienvenue " . $user->getUsername() . " sur la premiere page";
                $session = $this->get("session");
                $session->set('filter', array(
                    "idRole" => $user->getRole()->getId(),
                    "username" => $user->getUsername(),
                    "idUser" => $user->getId()
                ));

                //dd($session);
                return $this->render('view/index.html.twig', ["title"=>$this->title]);
            }
        }*/

        return $this->render('View/index', ["title"=>$this->title]);
    }

    /**
     * @Route("/logout", name="logout")
     *
     */
    public function logout():Response
    {
        $session = $this->get('session');
        $session->remove('filter');
        return $this->render('view/index.html.twig',['title'=>$this->title]);

    }



}
