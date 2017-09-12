<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="f_name", columns={"f_name"}), @ORM\Index(name="l_name", columns={"l_name"}), @ORM\Index(name="b_day", columns={"b_day"}), @ORM\Index(name="email", columns={"email"}), @ORM\Index(name="company", columns={"company"}), @ORM\Index(name="w_address", columns={"w_adress"}), @ORM\Index(name="position", columns={"position"})})
 * @ORM\Entity
 */
class Users
{
    /**
     * @var string
     *
     * @ORM\Column(name="f_name", type="string", length=50, nullable=true)
     */
    private $fName;

    /**
     * @var string
     *
     * @ORM\Column(name="l_name", type="string", length=50, nullable=true)
     */
    private $lName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="b_day", type="date", nullable=true)
     */
    private $bDay;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="h_city", type="string", length=250, nullable=true)
     */
    private $hCity;

    /**
     * @var string
     *
     * @ORM\Column(name="h_zip", type="string", length=250, nullable=true)
     */
    private $hZip;

    /**
     * @var string
     *
     * @ORM\Column(name="h_address", type="string", length=250, nullable=true)
     */
    private $hAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=250, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=250, nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="w_city", type="string", length=250, nullable=true)
     */
    private $wCity;

    /**
     * @var string
     *
     * @ORM\Column(name="w_adress", type="string", length=250, nullable=true)
     */
    private $wAdress;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=250, nullable=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="cv", type="text", length=65535, nullable=true)
     */
    private $cv;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return string
     */
    public function getFName()
    {
        return $this->fName;
    }

    /**
     * @param string $fName
     */
    public function setFName($fName)
    {
        $this->fName = $fName;
    }

    /**
     * @return string
     */
    public function getLName()
    {
        return $this->lName;
    }

    /**
     * @param string $lName
     */
    public function setLName($lName)
    {
        $this->lName = $lName;
    }

    /**
     * @return \DateTime
     */
    public function getBDay()
    {
        return $this->bDay;
    }

    /**
     * @param \DateTime $bDay
     */
    public function setBDay($bDay)
    {
        $this->bDay = $bDay;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getHCity()
    {
        return $this->hCity;
    }

    /**
     * @param string $hCity
     */
    public function setHCity($hCity)
    {
        $this->hCity = $hCity;
    }

    /**
     * @return string
     */
    public function getHZip()
    {
        return $this->hZip;
    }

    /**
     * @param string $hZip
     */
    public function setHZip($hZip)
    {
        $this->hZip = $hZip;
    }

    /**
     * @return string
     */
    public function getHAddress()
    {
        return $this->hAddress;
    }

    /**
     * @param string $hAddress
     */
    public function setHAddress($hAddress)
    {
        $this->hAddress = $hAddress;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getWCity()
    {
        return $this->wCity;
    }

    /**
     * @param string $wCity
     */
    public function setWCity($wCity)
    {
        $this->wCity = $wCity;
    }

    /**
     * @return string
     */
    public function getWAdress()
    {
        return $this->wAdress;
    }

    /**
     * @param string $wAdress
     */
    public function setWAdress($wAdress)
    {
        $this->wAdress = $wAdress;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * @param string $cv
     */
    public function setCv($cv)
    {
        $this->cv = $cv;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


}
