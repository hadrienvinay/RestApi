<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InstantPaymentControllerTest extends WebTestCase
{
    public function testShowpayment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showPayment');
    }

}
