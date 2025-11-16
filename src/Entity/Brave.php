<?php

namespace App\Entity;

use App\Repository\BraveRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BraveRepository::class)]
class Brave
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $s = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getS(): ?string
    {
        return $this->s;
    }

    public function setS(string $s): static
    {
        $this->s = $s;

        return $this;
    }
}
