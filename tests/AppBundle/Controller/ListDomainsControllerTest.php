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
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/domain/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('List domains', $crawler->filter('h1')->text());
    }

    public function testLink() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/domain/');
        $link = $crawler
            ->filter('a:contains("new")') // find all links with the text "new"
            ->eq(0) // select the 1st link in the list
            ->link();

        $crawler = $client->click($link);
        $this->assertContains('Edit domain', $crawler->filter('h1')->text());
    }
}