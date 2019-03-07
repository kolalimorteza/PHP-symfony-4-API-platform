<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ApiResource()
 * @UniqueEntity(
 *     fields={"Name"},
 *     message="Your Product name has already been registered"
 * )
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="App Error: Name: This value should not be blank.")
     * @Assert\Length(min =4, max =100)
     */
    private $Name;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Assert\NotBlank(message="App Error: Price: This value should not be blank.")
     * @Assert\Regex("/^\d+(\.\d+)?/")
     */
    private $Price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }
    

    public function setName(?string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPrice()
    {
        return $this->Price;
    }

    public function setPrice($Price): self
    {
        $this->Price = $Price;

        return $this;
    }
}
