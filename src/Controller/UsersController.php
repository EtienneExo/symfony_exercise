<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UsersController extends AbstractController
{

    /**
     * @Route ("/account/new",name="account")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function accountForm(Request $request, EntityManagerInterface $manager): Response
    {
        ///dd($request); // Debug dump of the request

        // Render your template with the correct path
        return $this->render('View/auth/account.html.twig');
    }
}
