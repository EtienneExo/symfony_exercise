<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $title = "Bienvenue sur la première page";
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('View/index.html.twig',["title"=>$this->title,"age"=>18]);
    }
}
