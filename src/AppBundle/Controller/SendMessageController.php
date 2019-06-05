<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SendMessageController extends Controller
{
    public $header;

    /**
     * @return Response
     * View Kanest Response for accounts
     */
    public function getAccountsAction()
    {
        $url = "v1/accounts";

        $result = $this->getResult($url);

        return $this->render('AppBundle::home.html.twig', array(
            "header" => $this->header,
            "response" => json_decode($result),
        ));

    }

    /**
     * @return Response
     * View Kanest Response for an account
     */
    public function getAccountAction()
    {
        //$data = array("url" => "accounts/1");
        $url = "v1/accounts/1";
        $result = $this->getResult($url);

        return $this->render('AppBundle::home.html.twig', array(
            "header" => $this->header,
            "response" => json_decode($result),
        ));

    }

    /**
     * @param $data
     * @return false|string
     * Function use to get a data and send it to the Kanest Server
     */
    public function getResult($url){

        //$postdata = http_build_query($data);
        /*$test = array( 'resourceId' => 123,
            'bicFi' => "123",
            'accountId' => array(
                'iban' => "1564",
                'currency' => "5684",
            ));
        $jsonData = json_encode($test);*/

        $opts = array('http' =>
            array(
                'method'  => 'GET '.$url,
                'uri' => 'http://localhost/v1/accounts',
                'header'  => 'Content-type: application/json',//'Content-Length:'.strlen($jsonData).'',
                //'content' => $jsonData
            )
        );

        $context  = stream_context_create($opts);
        $result = file_get_contents('http://127.0.0.1:1514', "false", $context);

        $this->header = $http_response_header;

        return $result;
    }

}
