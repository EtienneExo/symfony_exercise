<?php

namespace App\Controller;


use App\Entity\Role;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
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
        ///
        $user = new User();

        $userForm = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('mail', EmailType::class)
            ->add('role', EntityType::class,['class'=>Role::class,'choice_label'=>'name'])->getForm();

        // Render your template with the correct path
        return $this->render('View/auth/account.html.twig',['formAccount'=>$userForm->createView()]);
    }
}
