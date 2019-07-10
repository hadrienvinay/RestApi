<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends Controller
{
    /**
     * @Route("/v1/payment-requests", name="payment_requests")
     * @Method({"POST"})
     */
    public function PostPaymentRequests(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $date = date('Y-m-d');

        //tests on message receive
      /*  if (empty($data)) {
            $error_model = array(
                "timestamp" => $date,
                "statusCode" => 404,
                "error" => "Bad Request",
                "message" => "Data send is empty",
                "path" => "/v1/payment-requests"
            );
            return new JsonResponse($error_model);
        }*/

        $formatted = array(
            "appliedAuthenticationApproach" => "REDIRECT",
            "_links" => array(
                'self' => array(
                    "href" => "/payment-requests",
                    "templated" => false
                ),
                'consentApproval' => array(
                    "href" => "https://aspsp_url/consents-approval"
                ),
            )
        );

        return new JsonResponse($formatted,201);
    }

}
