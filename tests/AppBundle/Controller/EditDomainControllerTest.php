<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 17.07.17
 * Time: 12:19
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EditDomainControllerTest extends WebTestCase
{
    private $editLink = false; // link to edit the new testdomain
    private $id = false; // id of the new testdomain
    private $testdomain = 'test0815.com';
    private $preTestdomain = 'edited-';

    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'andy',
            'PHP_AUTH_PW'   => 'andy123',
        ));
    }


    public function testNewEditDelete()
    {
        $crawler = $this->client->request('GET', '/domain/new');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Edit domain', $crawler->filter('h1')->text());

        /* create new testdomain: */
        echo 'new '.$this->testdomain."\n";
        $form = $crawler->selectButton('submit')->form();
        $form['domain[domain]'] = $this->testdomain;
        $crawler = $this->client->submit($form);
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode()); // redirection

        /* search testdomain in domainlist */
        $crawler = $this->client->request('GET', '/domain/');
        $this->assertContains($this->testdomain, $crawler->filter('table')->text());
        // read tds of table in an array:
        $rows = $crawler->filter('table')
            ->filter('tbody')->filter('tr')->each(function ($tr, $i) {
            return $tr->filter('td')->each(function ($td, $i) {
                return $td;
            });
        });
        // search the testdomain in this tds:
        foreach ($rows as $tds) {
            if ($tds[0]->text() == $this->testdomain) {
                $this->editLink = $tds[1]->filter('a')->link();
                $this->id = $tds[1]->filter('a')->attr('href');
                echo $this->testdomain.' has id = '.$this->id."\n";
            }
        }
        $this->assertGreaterThan(0, $this->id);

        /* edit testdomain: */
        echo 'edit '.$this->testdomain." to ".$this->preTestdomain.$this->testdomain."\n";
        $crawler = $this->client->click($this->editLink);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $form = $crawler->selectButton('submit')->form();
        $form->get('domain[domain]')->setValue($this->preTestdomain.$form->get('domain[domain]')->getValue());
        $crawler = $this->client->submit($form);
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode()); // redirection
        $crawler = $this->client->request('GET', '/domain/');
        $this->assertContains($this->preTestdomain.$this->testdomain, $crawler->filter('table')->text());

        /* remove testdomain: */
        echo 'delete '.$this->preTestdomain.$this->testdomain."\n";
        $crawler = $this->client->request('GET', '/domain/delete/'.$this->id);
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode()); // redirection
    }

}