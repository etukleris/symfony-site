<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users implements UserInterface, \Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="uidUsers", type="text", length=255, nullable=false)
     */
    private $uidusers;

    /**
     * @var string
     *
     * @ORM\Column(name="emailUsers", type="text", length=255, nullable=false)
     */
    private $emailusers;

    /**
     * @var string
     *
     * @ORM\Column(name="pwdUsers", type="text", nullable=false)
     */
    private $pwdusers;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeCreated", type="datetime", nullable=false)
     */
    private $timecreated = 'current_timestamp()';

    /**
     * @var string
     *
     * @ORM\Column(name="imageUser", type="string", length=100, nullable=true)
     */
    private $imageuser = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="idUsers", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusers;



    /**
     * Set uidusers
     *
     * @param string $uidusers
     *
     * @return Users
     */
    public function setUidusers($uidusers)
    {
        $this->uidusers = $uidusers;

        return $this;
    }

    /**
     * Get uidusers
     *
     * @return string
     */
    public function getUidusers()
    {
        return $this->uidusers;
    }

    /**
     * Set emailusers
     *
     * @param string $emailusers
     *
     * @return Users
     */
    public function setEmailusers($emailusers)
    {
        $this->emailusers = $emailusers;

        return $this;
    }

    /**
     * Get emailusers
     *
     * @return string
     */
    public function getEmailusers()
    {
        return $this->emailusers;
    }

    /**
     * Set pwdusers
     *
     * @param string $pwdusers
     *
     * @return Users
     */
    public function setPwdusers($pwdusers)
    {
        $this->pwdusers = $pwdusers;

        return $this;
    }

    /**
     * Get pwdusers
     *
     * @return string
     */
    public function getPwdusers()
    {
        return $this->pwdusers;
    }

    /**
     * Set timecreated
     *
     * @param \DateTime $timecreated
     *
     * @return Users
     */
    public function setTimecreated($timecreated)
    {
        $this->timecreated = $timecreated;

        return $this;
    }

    /**
     * Get timecreated
     *
     * @return \DateTime
     */
    public function getTimecreated()
    {
        return $this->timecreated;
    }

    /**
     * Set imageuser
     *
     * @param string $imageuser
     *
     * @return Users
     */
    public function setImageuser($imageuser)
    {
        $this->imageuser = $imageuser;

        return $this;
    }

    /**
     * Get imageuser
     *
     * @return string
     */
    public function getImageuser()
    {
        return $this->imageuser;
    }

    /**
     * Get idusers
     *
     * @return integer
     */
    public function getIdusers()
    {
        return $this->idusers;
    }
    
    /**
     * @Assert\NotBlank
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    //abstract classes
    private $salt = null;
    public function __construct()
    {
        //$this->isActive = true;
        // may not be needed, see section on salt below
        $this->salt = md5(uniqid('', true));
        $this->timecreated = (new \DateTime());
    }
    public function getRoles()
    {
        return ['ROLE_USER'];
    }
    public function getPassword()
    {
        return $this->pwdusers;
    }
    public function getUsername()
    {
        return $this->uidusers;
    }
    
    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->idusers,
            $this->uidusers,
            $this->pwdusers,
          
            $this->salt
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->idusers,
            $this->uidusers,
            $this->pwdusers,
           
            $this->salt
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }
    public function getSalt(){
      return $this->salt;
    }
    
}
