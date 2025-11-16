<?php

namespace App\Entity;

use App\Repository\KomponentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KomponentRepository::class)]
class Komponent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $Descriptions = null;

    #[ORM\Column(length: 255)]
    private ?string $Available = null;

    #[ORM\Column]
    private ?int $stocks = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescriptions(): ?string
    {
        return $this->Descriptions;
    }

    public function setDescriptions(string $Descriptions): static
    {
        $this->Descriptions = $Descriptions;

        return $this;
    }

    public function getAvailable(): ?string
    {
        return $this->Available;
    }

    public function setAvailable(string $Available): static
    {
        $this->Available = $Available;

        return $this;
    }

    public function getStocks(): ?int
    {
        return $this->stocks;
    }

    public function setStocks(int $stocks): static
    {
        $this->stocks = $stocks;

        return $this;
    }
}
