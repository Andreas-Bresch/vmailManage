<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 17.07.17
 * Time: 12:11
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListDomainsControllerTest extends WebTestCase
{

    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'andy',
            'PHP_AUTH_PW'   => 'andy123',
        ));
    }


    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/domain/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('List domains', $crawler->filter('h1')->text());
    }

    public function testLink() {
        $crawler = $this->client->request('GET', '/domain/');
        $link = $crawler
            ->filter('a:contains("new")') // find all links with the text "new"
            ->eq(0) // select the 1st link in the list
            ->link();
        $crawler = $this->client->click($link);
        $this->assertContains('Edit domain', $crawler->filter('h1')->text());
    }
}