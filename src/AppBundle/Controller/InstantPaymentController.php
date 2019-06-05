<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Payment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class InstantPaymentController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     * @Route("/paymentRequest")
     * @Method({"POST"})
     * @return JsonResponse
     */
    public function PaymentAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $date = new \DateTime();

        $paymentRequest = new Payment();
        $paymentRequest->setTransactionAmount($data['transactionAmount']);
        $paymentRequest->setOriginatorIban($data['originatorIban']);
        $paymentRequest->setBeneficiaryIban($data['beneficiaryIban']);
        //$paymentRequest->setDescription($data['description']);
        $paymentRequest->setRequestDate($date);

        $em = $this->getDoctrine()->getManager();
        $em->persist($paymentRequest);
        $em->flush();

        //Send a request to the receiver of the paiement
        //$this->sendPaymentAction($data);

        //generate success response
        $success = [
            "code" => 200,
            'message' => 'Paiement enregistré avec succès'
        ];

        return new JsonResponse($success,200);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPaymentsAction(){

        $em = $this->getDoctrine()->getManager();
        $payments = $em->getRepository('AppBundle:Payment')->findAll();

        return $this->render('AppBundle:InstantPayment:show_payments.html.twig', array(
            'payments' => $payments,
        ));
    }

    /**
     * @param $data
     * Get the Payment info and send it to Kanest receiver
     */
    public function sendPaymentAction($data){
        //Send a request to the receiver of the paiement
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://127.0.0.1:1514',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS =>  json_encode([
                'amount' => $data['amount'],
                'account' => $data['account'],
                'iban' => $data['iban'],
                'description' => $data['description'],
            ])
        ]);
        // Send the request & save response to $resp
        curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
    }


    /**
     * @Route("/getNumberPayment")
     * @Method({"GET"})
     */
    public function getNumberTransactionAction(){
    $em = $this->getDoctrine()->getManager();
    $payments = $em->getRepository('AppBundle:Payment')->findAll();

    $compteur=0;
    foreach ($payments as $payment){
        $compteur = $compteur+1;
    }
    $data = (array("size" => $compteur));

    return new JsonResponse($data);
    }

}
