<?php

namespace App\Controller\User;

use App\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetUsers extends ApiController
{
    /**
     * @Route("/users", name="get_users", methods={"GET"})
     */
    public function __invoke(Request $request)
    {
        return $this->commonActions($request);
    }

    protected function actions($request)
    {
        $users = $this->getDoctrine()->getRepository('App:User')->findAll();
        return $users;
    }
}
