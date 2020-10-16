<?php

namespace App\Controller\User;

use App\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api", methods={"PUT"})
 */
class UpdateUser extends ApiController
{
    /**
     * @Route("/user/{id}", name="update_user", methods={"PUT"})
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
        $user->setName($request->request->get('name'));
        $user->setUsername($request->request->get('username'));
        $user->setPassword($this->encoder->encodePassword($user, $request->request->get('password')));
        $user->setRoles($request->request->get('roles'));
        $em->persist($user);
        $em->flush();

        return $user;
    }
}
