<?php

namespace App\Entity;

use App\Repository\TiimerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TiimerRepository::class)]
class Tiimer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tiimers')]
    #[ORM\JoinColumn(nullable: false, name: "idUser", referencedColumnName: "id")]
    private $user;

    #[ORM\Column(type: 'time')]
    private $startTime;

    #[ORM\Column(type: 'time')]
    private $endTime;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $checked;

    #[ORM\Column(type: 'integer')]
    private $unchecked;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }



    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getChecked(): ?int
    {
        return $this->checked;
    }

    public function setChecked(int $checked): self
    {
        $this->checked = $checked;

        return $this;
    }

    public function getUnchecked(): ?int
    {
        return $this->unchecked;
    }

    public function setUnchecked(int $unchecked): self
    {
        $this->unchecked = $unchecked;

        return $this;
    }
}
