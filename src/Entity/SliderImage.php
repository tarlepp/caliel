<?php

namespace App\Entity;

use App\Repository\SliderImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SliderImageRepository::class)
 */
class SliderImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Slider::class, inversedBy="sliderImages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $slider;

    /**
     * @ORM\ManyToOne(targetEntity=Image::class, inversedBy="sliderImages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    public function __construct(Slider $slider, Image $image)
    {
        $this->createdAt = new \DateTime();
        $this->slider = $slider;
        $this->image = $image;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSlider(): ?Slider
    {
        return $this->slider;
    }

    public function setSlider(?Slider $slider): self
    {
        $this->slider = $slider;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }
}
