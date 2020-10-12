<?php

namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api", methods={"GET"})
 */
class ApiController extends AbstractFOSRestController
{
    const JSON = "json";

    /**
     * @Route("/index", name="index", methods={"GET"})
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiController.php',
        ]);
    }

    /**
     * @Route("/user/{id}", name="get_user", methods={"GET"})
     */
    public function getUserAction($id)
    {
        $action = "Get User";
        try {
            $error = false;
            $status = Response::HTTP_OK;
            $user = $this->getDoctrine()->getRepository('App:User')->find($id);
        } catch (\Exception $ex) {
            $error = true;
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = "Error: {" . $ex->getMessage() . "}";
        }

        $response = [
            'action' => $action,
            'status' => $status,
            'data' => $error == false ? $user : $message,
        ];

        return new Response($this->get('serializer')->serialize($response, self::JSON), $status);
    }

    /**
     * @Route("/users", name="get_users", methods={"GET"})
     */
    public function getUsersAction()
    {
        $action = "Get Users";

        try {
            $error = false;
            $status = Response::HTTP_OK;
            $users = $this->getDoctrine()->getRepository('App:User')->findAll();
        } catch (\Exception $ex) {
            $error = true;
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = "Error: {" . $ex->getMessage() . "}";
        }

        $response = [
            'action' => $action,
            'status' => $status,
            'data' => $error == false ? $users : $message,
        ];

        return new Response($this->get('serializer')->serialize($response, self::JSON), $status);
    }

    /**
     * @Route("/user", name="new_user", methods={"POST"})
     */
    public function newUserAction(Request $request)
    {
        $action = "New Users";

        try {
            $em = $this->getDoctrine()->getManager();
            $status = Response::HTTP_OK;
            $error = false;

            $name = $request->request->get('name');
            $username = $request->request->get('username');
            $password = $request->request->get('password');
            $roles = $request->request->get('roles');

            $user = new User();
            $user->setName($name);
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRoles($roles);

            $em->persist($user);
            $em->flush();
        } catch (\Exception $ex) {
            $error = true;
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = "Error: {" . $ex->getMessage() . "}";
        }
        $response = [
            'action' => $action,
            'status' => $status,
            'data' => $error == false ? $user : $message,
        ];

        return new Response($this->get('serializer')->serialize($response, self::JSON), $status);
    }

    /**
     * @Route("/user/{id}", name="update_user", methods={"PUT"})
     */
    public function updateUser(Request $request, int $id)
    {

        $action = "Update User";

        try {
            $status = Response::HTTP_OK;
            $error = false;

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('App:User')->find($id);
            $name = $request->request->get('name');
            $username = $request->request->get('username');
            $password = $request->request->get('password');
            $roles = $request->request->get('roles');

            $user->setName($name);
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRoles($roles);

            $em->persist($user);
            $em->flush();
        } catch (\Exception $ex) {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $error = true;
            $message = "Error: {" . $ex->getMessage() . "}";
        }

        $response = [
            'action' => $action,
            'status' => $status,
            'data' => $error == false ? $user : $message,
        ];

        return new Response($this->get('serializer')->serialize($response, self::JSON), $status);
    }

    /**
     * @Route("/user/{id}", name="delete_user", methods={"DELETE"})
     */
    public function deleteUser(int $id)
    {
        $action = "Delete User";

        try {
            $status = Response::HTTP_OK;
            $error = false;
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('App:User')->find($id);
            $em->remove($user);
            $em->flush();
        } catch (\Exception $ex) {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $error = true;
            $message = "Error: {" . $ex->getMessage() . "}";
        }
        $response = [
            'action' => $action,
            'status' => $status,
            'data' => $error == false ? $user : $message,
        ];

        return new Response($this->get('serializer')->serialize($response, self::JSON), $status);
    }
}
