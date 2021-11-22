<?php

namespace App\Controller; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    
    /**
     *
     * @Route("/hello/{prenom}/age/{age}", name="hello")
     * @Route("/hello", name="hello_base")
     * 
     */
    public function hello($prenom = "anonyme",  $age="0")
    {
        return new Response("Bonjour " . $prenom . " a " . $age);
    }
        
    /**
     * @Route("/",name="homepage")
     */
    public function home():Response
    {
        return $this->render('home.html.twig',['title' => "Bonjour à tous",'age' => 22]);
    }


}

?>