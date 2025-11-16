<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Art = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArt(): ?string
    {
        return $this->Art;
    }

    public function setArt(string $Art): static
    {
        $this->Art = $Art;

        return $this;
    }
}
