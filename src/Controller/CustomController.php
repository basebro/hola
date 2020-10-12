<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CustomController extends AbstractController
{
    /**
     * @Route("/custom", name="custom")
     */
    public function custom()
    {
        return $this->render('custom/custom.html.twig', [
            'controller_name' => 'CustomController',
        ]);
    }
    /**
     * @Route("/page/1", name="page_1")
     */
    public function page1()
    {
        return $this->render('custom/page-1.html.twig', [
            'controller_name' => 'CustomController',
        ]);
    }
}
