<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FundController extends Controller
{
    /**
     * @Route("/v1/funds-confirmations", name="funds_confirmations")
     * @Method({"POST"})
     */
    public function PostFundsConfirmationsAction(Request $request)
    {
        /**
         * Status response : 200
         * No Specific Header
         */
        $data = json_decode($request->getContent(), true);
        $date = new \DateTime('NOW');
        //tests on message receive
        if (empty($data)) {
            $error_model = array(
                "timestamp" => "'".$date->format('c')."'",
                "statusCode" => 404,
                "error" => "Bad Request",
                "message" => "Data send is empty",
                "path" => "/v1/funds-confirmations"
            );
            return new JsonResponse($error_model);
        }


        if($data["instructedAmount"]["amount"] > 50000){
            $validResponse = "false";
        } else{
            $validResponse = "true";
        }

        //send the correct response
            $formatted = array(
                "request" => array(
                    "paymentCoverageRequestId" => $data['paymentCoverageRequestId'],
                    "instructedAmount" => array(
                        "currency" => $data["instructedAmount"]["currency"],
                        "amount" => $data["instructedAmount"]["amount"]
                    ),
                    "accountId" => array(
                        "iban" => $data["accountId"]["iban"]
                    ),
                ),
                "result" => $validResponse,
                "_links" => array(
                    'self' => array(
                        "href" => "/funds-confirmations",
                        "templated" => false
                    ),
                )
            );

        if (!empty($data['payee']) ) {
            $formatted['request']['payee'] = $data['payee'];
        }

        return new JsonResponse($formatted);

    }
}