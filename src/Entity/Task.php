<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use App\Entity\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $due_date = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $added_by = null;

  
    #[ORM\Column(length: 255, nullable: true)]
     private $status;

     #[ORM\Column(length: 255, nullable: true)]
     private $priority;
    
      


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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->due_date;
    }

    public function setDueDate(\DateTimeInterface $due_date): static
    {
        $this->due_date = $due_date;

        return $this;
    }

    public function getAddedBy(): ?User
    {
        return $this->added_by;
    }

    public function setAddedBy(?User $added_by): static
    {
        $this->added_by = $added_by;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getpriority(): ?string
    {
        return $this->priority;
    }

    public function setpriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }



}
