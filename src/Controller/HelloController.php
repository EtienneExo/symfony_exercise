<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    protected $logger;
    private $Title = "Hello ";

    public function __construct(LoggerInterface $logger)
    {
        $this->logger=$logger;
    }
    /**
     * @Route("/test/{name?world}", name="test",method={"GET","POST"},host=localhost,schemes={"http","htpps"})
     *
     */
    public function test($name)
    {
        $this->Title.=$name;
        return $this->render('View/item/hello.html.twig',["title"=>$this->Title]);
    }
}
