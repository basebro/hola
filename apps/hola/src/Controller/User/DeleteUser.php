<?php

namespace App\Controller\User;

use App\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api", methods={"DELETE"})
 */
class DeleteUser extends ApiController
{
    /**
     * @Route("/user/{id}", name="delete_user", methods={"DELETE"})
     */
    public function __invoke(Request $request)
    {
        return $this->commonActions($request);
    }

    protected function actions($request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->attributes->get('id');
        $user = $em->getRepository('App:User')->find($id);
        $em->remove($user);
        $em->flush();

        return $user;
    }
}
