<?php

namespace App\Controller\User;

use App\Controller\ApiController;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api", methods={"POST"})
 */
class NewUser extends ApiController
{
    /**
     * @Route("/user", name="new_user", methods={"POST"})
     */
    public function __invoke(Request $request)
    {
        return $this->commonActions($request);
    }

    protected function actions($request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setName($request->request->get('name'));
        $user->setUsername($request->request->get('username'));
        $user->setPassword($this->encoder->encodePassword($user, $request->request->get('password')));
        $user->setRoles($request->request->get('roles'));
        $em->persist($user);
        $em->flush();

        return $user;
    }
}
