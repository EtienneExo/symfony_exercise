<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;

class IndexController extends AbstractController
{
    private $title = "Bienvenue sur la première page";
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $formAccount = null;
        return $this->render('View/index.html.twig',["title"=>$this->title,"age"=>18,"editMode"=>false,'formAccount' => $formAccount]);
    }




}
