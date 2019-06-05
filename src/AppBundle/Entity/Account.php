<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRepository")
 * @ORM\Table(name="accounts")
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Balance", mappedBy="account")
     */
    public $balances;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Transaction", mappedBy="account")
     */
    public $transactions;

    /**
     * @ORM\Column(type="string")
     * @ORM\JoinColumn(nullable=true)
     */
    public $resourceId;

    /**
     * @ORM\Column(type="string")
     * @ORM\JoinColumn(nullable=true)
     */
    public $bicFi;

    /**
     * @ORM\Column(type="string")
     * @ORM\JoinColumn(nullable=true)
     */
    public $name;

    /**
     * @ORM\Column(type="string")
     */
    public $accountUse;

    /**
     * @ORM\Column(type="string")
     */
    public $cashAccountType;

    /**
     * @ORM\Column(type="string")
     */
    public $iban;

    /**
     * @ORM\Column(type="string")
     */
    public $currency;

    /**
     * @ORM\Column(type="string")
     */
    public $psuStatus;


    public function getId()
    {
        return $this->id;
    }

    public function getResourceId()
    {
        return $this->resourceId;
    }

    public function getBicFi()
    {
        return $this->bicFi;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setResourceId($resourceId)
    {
        $this->resourceId = $resourceId;
        return $this;
    }

    public function setBicFi($bicFi)
    {
        $this->bicFi = $bicFi;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccountUse()
    {
        return $this->accountUse;
    }

    /**
     * @param mixed $accountUse
     */
    public function setAccountUse($accountUse)
    {
        $this->accountUse = $accountUse;
    }

    /**
     * @return mixed
     */
    public function getCashAccountType()
    {
        return $this->cashAccountType;
    }

    /**
     * @param mixed $cashAccountType
     */
    public function setCashAccountType($cashAccountType)
    {
        $this->cashAccountType = $cashAccountType;
    }

    /**
     * @return mixed
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param mixed $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * @return mixed
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @param mixed $transactions
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getPsuStatus()
    {
        return $this->psuStatus;
    }

    /**
     * @param mixed $psuStatus
     */
    public function setPsuStatus($psuStatus)
    {
        $this->psuStatus = $psuStatus;
    }

    /**
     * @return mixed
     */
    public function getBalances()
    {
        return $this->balances;
    }

    /**
     * @param mixed $balances
     */
    public function setBalances($balances)
    {
        $this->balances = $balances;
    }



}