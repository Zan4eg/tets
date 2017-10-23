<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="image")
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", name="src")
     * @Assert\NotBlank(message="Shouldn't be blank")
     * @Assert\File()
     */
    private $src;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="images")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getImage()
    {
        return $this->src;
    }

    public function setImage($imageFile)
    {
        $this->src = $imageFile;
    }

    public function save($folder)
    {
        $fileName = md5(uniqid()) . '.' . $this->src->guessExtension();

        $this->src->move(
            $folder,
            $fileName
        );

        $this->src = $fileName;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }
}
