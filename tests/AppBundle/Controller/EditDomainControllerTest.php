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
    private $editLink = false;
    private $id = false;
    private $testdomain = 'test0815.com';
    private $preTestdomain = 'edited-';

    public function testNewEditDelete()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/domain/new');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Edit domain', $crawler->filter('h1')->text());

        /* create new testdomain: */
        echo 'new '.$this->testdomain."\n";
        $form = $crawler->selectButton('submit')->form();
        $form['domain[domain]'] = $this->testdomain;
        $crawler = $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode()); // redirection

        /* search testdomain in domainlist */
        $crawler = $client->request('GET', '/domain/');
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
        $crawler = $client->click($this->editLink);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $form = $crawler->selectButton('submit')->form();
        $form->get('domain[domain]')->setValue($this->preTestdomain.$form->get('domain[domain]')->getValue());
        $crawler = $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode()); // redirection
        $crawler = $client->request('GET', '/domain/');
        $this->assertContains($this->preTestdomain.$this->testdomain, $crawler->filter('table')->text());

        /* remove testdomain: */
        echo 'delete '.$this->preTestdomain.$this->testdomain."\n";
        $crawler = $client->request('GET', '/domain/delete/'.$this->id);
        $this->assertEquals(302, $client->getResponse()->getStatusCode()); // redirection
    }

}