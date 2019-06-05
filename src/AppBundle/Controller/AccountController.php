<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use AppBundle\Form\AccountType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends Controller
{
    /**
     * @Route("/v1/accounts", name="accounts_list")
     * @Method({"GET"})
     */
    public function GetAccountsAction()
    {
        $accounts = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Account')
            ->findAll();

        $array_accounts = array();

        foreach ($accounts as $account) {
            $array_accounts[] = [
                'resourceId' => $account->getResourceId(),
                'bicFi' => $account->getBicFi(),
                'accountId' => array(
                    'iban' => $account->getIban(),
                    'currency' => $account->getCurrency(),
                ),
                'name' => $account->getName(),
                'details' => "détails du compte",
                'linkedAccount' => "cash account of the card if there is a pending card transactions",
                'usage' => $account->getAccountUse(),
                'cashAccountType' => $account->getCashAccountType(),
                'product' => "Product name of the Bank",
                //list des balances
                'psuStatus' => $account->getPsuStatus(),
                '_links' => array(
                    'balances' => array(
                        "href" => "accounts/" . $account->getId() . "/balances"
                    ),
                    'transactions' => array(
                        "href" => "accounts/" . $account->getId() . "/transactions"
                    ),
                ),
            ];
        }

        $links = [
            'self' => array(
                "href" => "accounts/"
            ),
            'first' => array(
                "href" => "accounts/1"
            ),
        ];

        $formatted = array("accounts" => $array_accounts, '_links' => $links);

        $response = $formatted;

        return new JsonResponse($response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/v1/accounts/{account_id}", name="account")
     * @Method({"GET"})
     */
    public function GetAccountAction(Request $request)
    {
        $account = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Account')
            ->find($request->get('account_id'));

        if (empty($account)) {
            return new JsonResponse([
                'code' => 404 ,
                'message' => 'Account not found'
                ],
                Response::HTTP_NOT_FOUND);
        }

        $selectedAccount = array(
            'resourceId' => $account->getResourceId(),
            'bicFi' => $account->getBicFi(),
            'name' => $account->getName(),
            'details' => "détails du compte",
            'usage' => $account->getAccountUse(),
            'cashAccountType' => $account->getCashAccountType(),
            'accountId' => array(
                'iban' => $account->getIban(),
                'currency' => $account->getCurrency(),
            ),
            'psuStatus' => $account->getPsuStatus(),
            '_links' => array(
                'balances' => array(
                    "href" => "accounts/" . $account->getId() . "/balances"
                ),
                'transactions' => array(
                    "href" => "accounts/" . $account->getId() . "/transactions"
                ),
            ),
        );

        $formatted = array("account" => $selectedAccount);

        return new JsonResponse($formatted);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/v1/accounts/{account_id}/balances", name="balances")
     * @Method({"GET"})
     */
    public function GetAccountBalancesAction(Request $request)
    {
        $account = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Account')
            ->find($request->get('account_id'));

        if (empty($account)) {
            return new JsonResponse([
                'code' => 400,
                'message' => 'Account not found'
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $balances = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Balance')
            ->findByAccount($account);

        $array_balances = array();
        $date = date('d-m-Y');

        foreach ($balances as $balance) {
            $array_balances[] = [
                "name" => "Solde comptable au ".$date,
                "balanceAmount" => array(
                    "currency" => $balance->getCurrency(),
                    "amount" => strval($balance->GetAmount())
                ),
                "balanceType" => $balance->getType(),
                "lastChangeDateTime" => $balance->getLastChangeDateTime()->format("Y-m-d"),
                "referenceDate" => $balance->getReferenceDate()->format("Y-m-d"),
                "lastCommittedTransaction" => $balance->getLastTransaction()
            ];
        }

        $links = [
            'self' => array(
                "href" => "accounts/".$account->getId()."/balances"
            ),
            'parent-list' => array(
                "href" => "accounts/"
            ),
            'transactions' => array(
                "href" => "accounts/".$account->getId()."/transactions"
            ),
        ];

        $formatted = array("balances" => $array_balances, "_links" => $links);

        return new JsonResponse($formatted);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/v1/accounts/{account_id}/transactions", name="transactions")
     * @Method({"GET"})
     */
    public function GetAccountTransactionsAction(Request $request)
    {
        $account = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Account')
            ->find($request->get('account_id'));

        if (empty($account)) {
            return new JsonResponse([
                'code'=>400,
                'message' => 'Account not found'
                ],
                Response::HTTP_NOT_FOUND);
        }

        $transactions = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Transaction')
            ->findByAccount($account);

        $array_transactions = array();

        foreach ($transactions as $transaction) {
            $array_transactions[] = [
                "resourceId" => $transaction->getAccount()->getResourceId(),
                "entryReference" => $transaction->getEntryReference(),
                "transactionAmount" => array(
                    "currency" => $transaction->getCurrency(),
                    "amount" => $transaction->GetAmount()
                ),
                "creditDebitIndicator" => $transaction->getCreditDebitIndicator(),
                "status" => $transaction->getStatus(),
                "bookingDate" => $transaction->getBookingDate()->format("Y-m-d"),
                "valueDate" => $transaction->getValueDate()->format("Y-m-d"),
                "transactionDate" => $transaction->getTransactionDate()->format("Y-m-d"),
                "remittanceInformation" => $transaction->getRemittanceInformation()
            ];
        }

        $links = [
            'self' => array(
                "href" => "accounts/".$account->getId()."/transactions"
            ),
            'parent-list' => array(
                "href" => "accounts/"
            ),
            'balances' => array(
                "href" => "accounts/".$account->getId()."/balances"
            ),
        ];

        $formatted = array("transactions" => $array_transactions, "_links" => $links);

        return new JsonResponse($formatted);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addAccountAction(Request $request){

        $account = new Account();
        $em = $this->getDoctrine()->getManager();
        $accounts = $em->getRepository('AppBundle:Account')->findAll();
        // Creating a form with Bill type specs
        $form = $this->get('form.factory')->create(AccountType::class,$account);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->persist($account);
            $em->flush();
            return $this->redirectToRoute('account_create');

        }
        return $this->render('AppBundle::addAccount.html.twig', array(
            'form' => $form->createView(),
            'accounts' => $accounts,
        ));
    }

    /**
     * @return JsonResponse
     * @Route("/v1/accounts/{account_id}/erreur", name="account_error")
     * @Method({"GET"})
     */
    public function ErreurAction()
    {
            return new JsonResponse([
                'code' => 404,
                'message' => 'Account not found'
            ],
                Response::HTTP_NOT_FOUND);
    }

}
