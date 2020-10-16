<?php

namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

abstract class ApiController extends AbstractFOSRestController
{
    const FORMAT = "json";
    const NULL_VALUE = null;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function commonActions(Request $request)
    {
        try {
            $status = Response::HTTP_OK;
            $action = $this->actions($request);
            $response = ["results" => $action];
        } catch (\Exception $ex) {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response = ['message' => $ex->getMessage()];
        }

        return new Response($this->get('serializer')->serialize($response, self::FORMAT), $status);
    }

    abstract protected function actions(Request $request);
}
