<?php
namespace App\Tests\legacy;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{
    public function testLoadHomepage()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request('GET', '/hello');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}