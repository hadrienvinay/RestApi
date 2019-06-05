<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ConsentController extends Controller
{
    /**
     * @Route("/v1/consents", name="consents")
     * @Method({"PUT"})
     */
    public function PutConsentsAction(Request $request)
    {
        /**
         * Status response : 200
         * No Specific Header
         */
        $data = json_decode($request->getContent(), true);
        $date = date('Y-m-d');

        //tests on message receive
        if (empty($data)) {
            $error_model = array(
                "timestamp" => $date,
                "code" => 404,
                "error" => "Bad Request",
                "message" => "Data send is empty",
                "path" => "/v1/funds-confirmations"
            );
            return new JsonResponse($error_model);
        }

        $response = new Response();
        $response->setStatusCode(201);

        return $response;

    }


    /**
     * @Route("/v1/end-user-identity", name="end_user_identity")
     * @Method({"GET"})
     */
    public function GetUserIdentity(Request $request)
    {
        $formatted = array(
            "connectedPsu" => "Mme Dupond",
            "_links" => array(
                'self' => array(
                    "href" => "/v1/end-user-identity",
                    "templated" => false
                ),
                'parent-list' => array(
                    "href" => "v1/accounts"
                ),
            )
        );

        return new JsonResponse($formatted,200);
    }

    /**
     * @Route("/v1/trusted-beneficiaries", name="trusted_beneficiaries")
     * @Method({"GET"})
     */
    public function GetTrustedBeneficiaries(Request $request)
    {

        $array_beneficiaries[] = [
            "id" => "12347",
            "isTrusted" => "true",
            "creditorAgent" => array(
                "bicFi" => "BANKYYQXXXX"
            ),
            "creditor" => array(
                "name" => "MyMerchant",
                "postalAddress" => array(
                    "country" => "FR",
                    "addressLine" => ["18 rue DSP2","75008 Paris"]
                ),
                "organisationId" => array(
                    "identification" => "852126789",
                    "schemeName" => "SREN",
                    "issuer" => "FR"
                )
            ),
            "creditorAccount" => array(
                "iban" => "YY64COJH41059545330222956960771321"
            )
        ];

        $links = [
            'self' => array(
                "href" => "v1/trusted-beneficiaries"
            ),
            'parent-list' => array(
                "href" => "v1/accounts"
            ),
        ];

        $formatted = array("beneficiaries" => $array_beneficiaries, '_links' => $links);

        $response = $formatted;

        return new JsonResponse($response,200);
    }



}