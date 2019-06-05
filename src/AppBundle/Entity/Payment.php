<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentRepository")
 */
class Payment
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
     * @var float
     *
     * @ORM\Column(name="transactionAmount", type="float")
     */
    private $transactionAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="originatorIban", type="string", length=255)
     */
    private $originatorIban;

    /**
     * @var string
     *
     * @ORM\Column(name="beneficiaryIban", type="string", length=255)
     */
    private $beneficiaryIban;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="requestDate", type="datetime")
     */
    private $requestDate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getTransactionAmount()
    {
        return $this->transactionAmount;
    }

    /**
     * @param float $transactionAmount
     */
    public function setTransactionAmount($transactionAmount)
    {
        $this->transactionAmount = $transactionAmount;
    }

    /**
     * @return string
     */
    public function getOriginatorIban()
    {
        return $this->originatorIban;
    }

    /**
     * @param string $originatorIban
     */
    public function setOriginatorIban($originatorIban)
    {
        $this->originatorIban = $originatorIban;
    }

    /**
     * @return string
     */
    public function getBeneficiaryIban()
    {
        return $this->beneficiaryIban;
    }

    /**
     * @param string $beneficiaryIban
     */
    public function setBeneficiaryIban($beneficiaryIban)
    {
        $this->beneficiaryIban = $beneficiaryIban;
    }

    /**
     * @return \DateTime
     */
    public function getRequestDate()
    {
        return $this->requestDate;
    }

    /**
     * @param \DateTime $requestDate
     */
    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}
