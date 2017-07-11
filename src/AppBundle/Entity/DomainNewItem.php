<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 06.07.17
 * Time: 21:59
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="domains")
 */
class DomainNewItem
{

    /**
     * workaround because of unsupported database-structure (foreign key not primary key)
     *
     * ORM\Column(type="integer")
     * ORM\Id
     * ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * workaround because of unsupported database-structure (foreign key not primary key)
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, unique=true)
     * @ORM\Id
     */
    private $domain;


    /** ToDo: wird das benoetigt?
     * @ORM\OneToMany(targetEntity="Account", mappedBy="domain")
     */
    private $accounts;


    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param mixed $accounts
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * ToDo: Schlechte Loesung! Aber sonst klappt das Speichern des Accounts nicht.
     * @return mixed
     */
    public function __toString() {
        return $this->domain;
    }

}