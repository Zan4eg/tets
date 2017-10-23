<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $user_id = null;
    

    /**
     * @ORM\Column(type="string", name="firstname", length=255, unique=false, nullable=false)
     * @Assert\NotBlank(groups={"basic_data"})
     * @Assert\Length(
     *      max = 255,
     *      minMessage = "Имя не может быть таким длинным",
     *      groups={"basic_data"}
     * )
     * @Assert\Regex("~^\D+$~")
     */
    public $firstname = null;

    /**
     * @ORM\Column(type="string", name="lastname", length=255, unique=false, nullable=false)
     * @Assert\NotBlank(groups={"basic_data"})
     * @Assert\Length(
     *      max = 255,
     *      minMessage = "Имя не может быть таким длинным",
     *      groups={"basic_data"}
     * )
     * @Assert\Regex("~^\D+$~")
     */
    public $lastname = null;

    /**
     * @ORM\Column(type="string", name="middlename", length=255, unique=false, nullable=false)
     * @Assert\NotBlank(groups={"basic_data"})
     * @Assert\Length(
     *      max = 255,
     *      minMessage = "Имя не может быть таким длинным",
     *      groups={"basic_data"}
     * )
     * @Assert\Regex("~^\D+$~")   
     */
    public $middlename = null;

    /**
     * @ORM\Column(type="date", name="birthdate", nullable = false)
     * @Assert\NotBlank(groups={"advanced_data"})
     * @Assert\Date(groups={"advanced_data"})
     */
    public $birthdate = null;

    /**
     * @ORM\Column(type="boolean", name="sex", nullable = false)
     * @Assert\NotBlank(groups={"advanced_data"})
     */
    protected $sex = null;

    /**
     * @ORM\Column(type="string", name="city", nullable = false)
     * @Assert\NotBlank(groups={"advanced_data"})
     * @Assert\Length(
     *      max = 255,
     *      groups={"advanced_data"}
     * )
     * @Assert\Regex("~^\D+$~")
     */
    public $city = null;


    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="user", cascade={"persist","remove"}, orphanRemoval=true)
     */
    public $images;


    /**
     * @ORM\Column(type="smallint", name="moderated", nullable=false)
     * @Assert\Length(
     *      max = 2,
     * )
     */
    private $moderated = 0;
    

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->images->add(new Image($this));
        $this->images->add(new Image($this));
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    public function getSex()
    {
        return $this->sex;
    }
    public function getSexLabel()
    {
        return array_search($this->sex, self::sexConditions());
    }

    public static function sexConditions()
    {
        return ['Male' => false, 'Female' => true];
    }

    public function getModerated()
    {
        return $this->moderated;
    }

    public function getModeratedLabel()
    {
        return array_search($this->moderated, self::moderatedConditions(true));;
    }

    public function setModerated($moderated)
    {
        $this->moderated = $moderated;
    }

    public static function moderatedConditions($flip = false)
    {
        $arr = [0 => 'Pending', 1 => 'Failed', 2 => 'Success'];

        // sonata в разных местах требует разную нотацию для choice
        if ($flip) {
            $arr = array_flip($arr);
        }

        return $arr;
    }

    public function getImagesList()
    {
        $list = [];

        foreach ($this->images as $value) {
            $list[] = $value->getImage();
        }

        return $list;
    }
}
