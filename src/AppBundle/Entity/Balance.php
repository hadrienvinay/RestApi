<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Balance
 *
 * @ORM\Table(name="balance")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BalanceRepository")
 */
class Balance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="balances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $account;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=255)
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastChangeDateTime", type="date", nullable=true)
     */
    private $lastChangeDateTime;

    /**
     * @var /DateTime
     *
     * @ORM\Column(name="referenceDate", type="date",nullable=true)
     */
    private $referenceDate;

    /**
     * @var string
     *
     * @ORM\Column(name="lastTransaction", type="string", length=255)
     */
    private $lastTransaction;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Balance
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return Balance
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Balance
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getLastChangeDateTime()
    {
        return $this->lastChangeDateTime;
    }

    /**
     * @param mixed $lastChangeDateTime
     */
    public function setLastChangeDateTime($lastChangeDateTime)
    {
        $this->lastChangeDateTime = $lastChangeDateTime;
    }

    /**
     * @return mixed
     */
    public function getReferenceDate()
    {
        return $this->referenceDate;
    }

    /**
     * @param mixed $referenceDate
     */
    public function setReferenceDate($referenceDate)
    {
        $this->referenceDate = $referenceDate;
    }

    /**
     * Set lastTransaction
     *
     * @param string $lastTransaction
     *
     * @return Balance
     */
    public function setLastTransaction($lastTransaction)
    {
        $this->lastTransaction = $lastTransaction;

        return $this;
    }

    /**
     * Get lastTransaction
     *
     * @return string
     */
    public function getLastTransaction()
    {
        return $this->lastTransaction;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }


}

