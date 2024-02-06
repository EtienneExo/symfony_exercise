<?php

namespace App\Entity;

use App\Repository\UsersControllerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @ORM\Entity(repositoryClass=UsersControllerRepository::class)
 */
class UsersController
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @Route ("/account/new",name="account")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function accountForm(Request $request,EntityManagerInterface $manager ):Response
    {
        dd($request);
        return $this->render('View/auth/account.html.twig');
    }
}
