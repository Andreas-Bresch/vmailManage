<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 07.07.17
 * Time: 20:57
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="aliases")
 */
class Alias
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=64)
     */
    private $source_username;


    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Domain")
     * @ORM\JoinColumn(name="source_domain", referencedColumnName="domain")
     */
    private $source_domain;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=64)
     */
    private $destination_username;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $destination_domain;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

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
    public function getSource_Username()
    {
        return $this->source_username;
    }
    public function getSourceUsername()
    {
        return $this->source_username;
    }

    /**
     * @param mixed $source_username
     */
    public function setSource_Username($source_username)
{
    $this->source_username = $source_username;
}
    public function setSourceUsername($source_username)
    {
        $this->source_username = $source_username;
    }

    /**
     * @return mixed
     */
    public function getSource_Domain()
    {
        return $this->source_domain;
    }
    public function getSourceDomain()
    {
        return $this->source_domain;
    }

    /**
     * @param mixed $source_domain
     */
    public function setSource_Domain($source_domain)
    {
        $this->source_domain = $source_domain;
    }
    public function setSourceDomain($source_domain)
    {
        $this->source_domain = $source_domain;
    }

    /**
     * @return mixed
     */
    public function getDestination_Username()
    {
        return $this->destination_username;
    }
    public function getDestinationUsername()
    {
        return $this->destination_username;
    }

    /**
     * @param mixed $destination_username
     */
    public function setDestination_Username($destination_username)
    {
        $this->destination_username = $destination_username;
    }
    public function setDestinationUsername($destination_username)
    {
        $this->destination_username = $destination_username;
    }

    /**
     * @return mixed
     */
    public function getDestination_Domain()
    {
        return $this->destination_domain;
    }
    public function getDestinationDomain()
    {
        return $this->destination_domain;
    }

    /**
     * @param mixed $destination_domain
     */
    public function setDestination_Domain($destination_domain)
    {
        $this->destination_domain = $destination_domain;
    }
    public function setDestinationDomain($destination_domain)
    {
        $this->destination_domain = $destination_domain;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }




}