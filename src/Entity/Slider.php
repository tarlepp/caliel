<?php

namespace App\Entity;

use App\Repository\SliderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SliderRepository::class)
 */
class Slider
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=SliderImage::class, mappedBy="slider")
     */
    private $sliderImages;

    public function __construct()
    {
        $this->sliderImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|SliderImage[]
     */
    public function getSliderImages(): Collection
    {
        return $this->sliderImages;
    }

    public function addSliderImage(SliderImage $sliderImage): self
    {
        if (!$this->sliderImages->contains($sliderImage)) {
            $this->sliderImages[] = $sliderImage;
            $sliderImage->setSlider($this);
        }

        return $this;
    }

    public function removeSliderImage(SliderImage $sliderImage): self
    {
        if ($this->sliderImages->removeElement($sliderImage)) {
            // set the owning side to null (unless already changed)
            if ($sliderImage->getSlider() === $this) {
                $sliderImage->setSlider(null);
            }
        }

        return $this;
    }
}
