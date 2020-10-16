<?php

namespace App\Controller\User;

use App\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetOneUser extends ApiController
{
    /**
     * @Route("/user/{id}", name="get_one_user", methods={"GET"})
     */
    public function __invoke(Request $request)
    {
        return $this->commonActions($request);
    }

    protected function actions($request)
    {
        $id = $request->attributes->get('id', parent::NULL_VALUE);
        $user = $this->getDoctrine()->getRepository('App:User')->find($id);
        
        return $user;
    }
}
