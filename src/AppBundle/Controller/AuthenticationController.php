<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationController extends Controller
{
    /**
     * @Route("/v1/authorize", name="authorize")
     * @Method({"GET"})
     */
    public function GetAuthorizationCode(Request $request)
    {
        $uri = $_SERVER['REQUEST_URI'];
        if(isset($_GET['redirect_uri'])) $redirect_uri = $_GET['redirect_uri'];
        if(isset($_GET['client_id'])) $clientId = $_GET['client_id'];
        if(isset($_GET['scope'])) $scope = $_GET['scope'];
        if(isset($_GET['response_type'])) $responseType = $_GET['response_type'];

        $date = new \DateTime();

        if($clientId != "8WrD5PFWyVTJKbrnMwAD70oFLYzB5ovX"){
            $error_model = array(
                "timestamp" => $date,
                "statusCode" => 400,
                "error" => "Bad Request",
                "message" => "Wrong client id",
                "path" => "/authorize"
            );
            return new JsonResponse($error_model);
        }
        $code = "12345678";

        header("Location: $redirect_uri?code=$code");

        return new Response( "",Response::HTTP_OK);
    }

    /**
     * @Route("/v1/token", name="token")
     * @Method({"POST"})
     */
    public function PostAccessToken(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $date = new \DateTime();

        $grantType = $data['grant_type'];
        $clientId = $data['client_id'];

        $accessToken = "xxx";
        $refreshToken = "yyy";

        echo $clientId;
        if($clientId != "8WrD5PFWyVTJKbrnMwAD70oFLYzB5ovX"){
            $error_model = array(
                "timestamp" => $date,
                "statusCode" => 400,
                "error" => "Bad Request",
                "message" => "Wrong client id",
                "path" => "/token"
            );
            return new JsonResponse($error_model);
        }

        if ($grantType=="authorization_code"){
            $code = $data['code'];

            if($code != "12345678"){
                $error_model = array(
                    "timestamp" => $date,
                    "statusCode" => 400,
                    "error" => "Bad Request",
                    "message" => "Wrong code for this client id",
                    "path" => "/token"
                );
                return new JsonResponse($error_model);
            }

            $formatted = array(
                "access_token" => $accessToken,
                "token_type" => "Bearer",
                "expires_in" => 90000,
                "refresh_token" => $refreshToken,
            );

        }
        elseif ($grantType=="refresh_token"){
            $formatted = array(
                "access_token" => $accessToken,
                "token_type" => "Bearer",
                "expires_in" => 80000,
                "refresh_token" => $refreshToken,
            );
        }
        elseif ($grantType=="password"){
            $formatted = array(
                "access_token" => $accessToken,
                "token_type" => "Bearer",
                "expires_in" => 70000,
                "refresh_token" => $refreshToken,
            );
        }
        else{
            $error_model = array(
                "timestamp" => $date,
                "statusCode" => 400,
                "error" => "Not Found",
                "message" => "Invalid grant_type",
                "path" => "/token"
            );
            return new JsonResponse($error_model);
        }

        return new JsonResponse($formatted,200);
    }


    /**
     * @Route("/v1/revoke", name="revoke")
     * @Method({"POST"})
     */
    public function PostRevocationToken()
    {
        return new Response("",Response::HTTP_OK);
    }

    /**
     * @Route("/code", name="code")
     * @Method({"GET"})
     */
    public function GetCode()
    {
       $code = $_GET['code'];

        return new Response($code,Response::HTTP_OK);
    }





}