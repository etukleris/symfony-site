<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pictures
 *
 * @ORM\Table(name="pictures")
 * @ORM\Entity
 */
class Pictures
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateadded", type="datetime", nullable=false)
     */
    private $dateadded = 'current_timestamp()';

    /**
     * @var string
     *
     * @ORM\Column(name="useradded", type="string", length=100, nullable=false)
     */
    private $useradded;

    /**
     * @var string
     *
     * @ORM\Column(name="imagename", type="string", length=100, nullable=false)
     */
    private $imagename;

    /**
     * @var string
     *
     * @ORM\Column(name="cattype", type="string", length=100, nullable=false)
     */
    private $cattype;

    /**
     * @var string
     *
     * @ORM\Column(name="catcharacteristics", type="string", length=100, nullable=false)
     */
    private $catcharacteristics;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set dateadded
     *
     * @param \DateTime $dateadded
     *
     * @return Pictures
     */
    public function setDateadded($dateadded)
    {
        $this->dateadded = $dateadded;

        return $this;
    }

    /**
     * Get dateadded
     *
     * @return \DateTime
     */
    public function getDateadded()
    {
        return $this->dateadded;
    }

    /**
     * Set useradded
     *
     * @param string $useradded
     *
     * @return Pictures
     */
    public function setUseradded($useradded)
    {
        $this->useradded = $useradded;

        return $this;
    }

    /**
     * Get useradded
     *
     * @return string
     */
    public function getUseradded()
    {
        return $this->useradded;
    }

    /**
     * Set imagename
     *
     * @param string $imagename
     *
     * @return Pictures
     */
    public function setImagename($imagename)
    {
        $this->imagename = $imagename;

        return $this;
    }

    /**
     * Get imagename
     *
     * @return string
     */
    public function getImagename()
    {
        return $this->imagename;
    }

    /**
     * Set cattype
     *
     * @param string $cattype
     *
     * @return Pictures
     */
    public function setCattype($cattype)
    {
        $this->cattype = $cattype;

        return $this;
    }

    /**
     * Get cattype
     *
     * @return string
     */
    public function getCattype()
    {
        return $this->cattype;
    }

    /**
     * Set catcharacteristics
     *
     * @param string $catcharacteristics
     *
     * @return Pictures
     */
    public function setCatcharacteristics($catcharacteristics)
    {
        if (is_array ( $catcharacteristics )){
          $this->catcharacteristics = implode( ", ", $catcharacteristics );
        } else { 
          $this->catcharacteristics = $catcharacteristics;
        }

        return $this;
    }

    /**
     * Get catcharacteristics
     *
     * @return string
     */
    public function getCatcharacteristics()
    {
        return $this->catcharacteristics;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    
    public function __construct()
    {
        //$this->isActive = true;
        // may not be needed, see section on salt below
        $this->dateadded = (new \DateTime());
    }
}
