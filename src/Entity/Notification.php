<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
#[ORM\Table(name: 'notification')]  // Nom de la table
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;  // Type de notification (like ou commentaire)

    // Polymorphisme pour pouvoir associer des commentaires/likes à des articles ou des vidéos
    #[ORM\Column(type: 'integer')]
    private ?int $notifiable_id = null;  // ID de l'objet (video, article, etc.)

    #[ORM\Column(length: 255)]
    private ?string $notifiable_type = null;  // Type de l'objet (video, article)

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $created_at = null;  // Date de création de la notification

    // Relation avec l'utilisateur (l'utilisateur qui reçoit la notification)
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();  // Initialiser la date de création lors de la création de la notification
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getNotifiableId(): ?int
    {
        return $this->notifiable_id;
    }

    public function setNotifiableId(int $notifiable_id): self
    {
        $this->notifiable_id = $notifiable_id;
        return $this;
    }

    public function getNotifiableType(): ?string
    {
        return $this->notifiable_type;
    }

    public function setNotifiableType(string $notifiable_type): self
    {
        $this->notifiable_type = $notifiable_type;
        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }
}
