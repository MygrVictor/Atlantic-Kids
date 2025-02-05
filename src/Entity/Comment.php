<?php
namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ORM\Table(name: 'comment')]  // Assurez-vous que le nom de la table soit correct
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $content = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $created_at = null;

    // Colonnes polymorphiques
    #[ORM\Column(type: 'integer')]
    private ?int $commentable_id = null;

    #[ORM\Column(length: 255)]
    private ?string $commentable_type = null;

    // Relation avec l'utilisateur
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    // Relation avec les likes
    #[ORM\OneToMany(mappedBy: 'comment', targetEntity: Like::class)]
    private $likes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
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

    public function getCommentableId(): ?int
    {
        return $this->commentable_id;
    }

    public function setCommentableId(int $commentable_id): self
    {
        $this->commentable_id = $commentable_id;
        return $this;
    }

    public function getCommentableType(): ?string
    {
        return $this->commentable_type;
    }

    public function setCommentableType(string $commentable_type): self
    {
        $this->commentable_type = $commentable_type;
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

    public function getLikes()
    {
        return $this->likes;
    }
}
