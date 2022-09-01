<?php

namespace App\Entity;

use App\Repository\TypeNoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeNoteRepository::class)]
class TypeNote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $type_note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeNote(): ?string
    {
        return $this->type_note;
    }

    public function setTypeNote(string $type_note): self
    {
        $this->type_note = $type_note;

        return $this;
    }

    public function __toString(): string
    {
        return  $this->getTypeNote();
    }
}
