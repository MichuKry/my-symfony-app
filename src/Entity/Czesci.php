<?php

namespace App\Entity;

use App\Repository\CzesciRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CzesciRepository::class)]
class Czesci
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $klocki_hamulcowe = null;

    #[ORM\Column]
    private ?bool $dostepne = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKlockiHamulcowe(): ?string
    {
        return $this->klocki_hamulcowe;
    }

    public function setKlockiHamulcowe(string $klocki_hamulcowe): static
    {
        $this->klocki_hamulcowe = $klocki_hamulcowe;

        return $this;
    }

    public function isDostepne(): ?bool
    {
        return $this->dostepne;
    }

    public function setDostepne(bool $dostepne): static
    {
        $this->dostepne = $dostepne;

        return $this;
    }
}
