<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransactionRepository")
 */
class Transaction
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="entryReference", type="string", length=255)
     */
    private $entryReference;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
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
     * @ORM\Column(name="creditDebitIndicator", type="string", length=255)
     */
    private $creditDebitIndicator;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bookingDate", type="date")
     */
    private $bookingDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="valueDate", type="date", nullable=true)
     */
    private $valueDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="transactionDate", type="date", nullable=true)
     */
    private $transactionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="remittanceInformation", type="string", length=255)
     */
    private $remittanceInformation;


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

    /**
     * Set entryReference
     *
     * @param string $entryReference
     *
     * @return Transaction
     */
    public function setEntryReference($entryReference)
    {
        $this->entryReference = $entryReference;

        return $this;
    }

    /**
     * Get entryReference
     *
     * @return string
     */
    public function getEntryReference()
    {
        return $this->entryReference;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Transaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
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
     * @return Transaction
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
     * Set creditDebitIndicator
     *
     * @param string $creditDebitIndicator
     *
     * @return Transaction
     */
    public function setCreditDebitIndicator($creditDebitIndicator)
    {
        $this->creditDebitIndicator = $creditDebitIndicator;

        return $this;
    }

    /**
     * Get creditDebitIndicator
     *
     * @return string
     */
    public function getCreditDebitIndicator()
    {
        return $this->creditDebitIndicator;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Transaction
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set bookingDate
     *
     * @param \DateTime $bookingDate
     *
     * @return Transaction
     */
    public function setBookingDate($bookingDate)
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    /**
     * Get bookingDate
     *
     * @return \DateTime
     */
    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    /**
     * @return \DateTime
     */
    public function getValueDate()
    {
        return $this->valueDate;
    }

    /**
     * @param \DateTime $valueDate
     */
    public function setValueDate($valueDate)
    {
        $this->valueDate = $valueDate;
    }

    /**
     * @return \DateTime
     */
    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    /**
     * @param \DateTime $transactionDate
     */
    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;
    }


    /**
     * Set remittanceInformation
     *
     * @param string $remittanceInformation
     *
     * @return Transaction
     */
    public function setRemittanceInformation($remittanceInformation)
    {
        $this->remittanceInformation = $remittanceInformation;

        return $this;
    }

    /**
     * Get remittanceInformation
     *
     * @return string
     */
    public function getRemittanceInformation()
    {
        return $this->remittanceInformation;
    }
}

