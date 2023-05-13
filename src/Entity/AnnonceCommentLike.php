<?php

namespace App\Entity;

use App\Repository\AnnonceCommentLikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceCommentLikeRepository::class)]
class AnnonceCommentLike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $count_annonceCommentLikes = null;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    private ?AnnonceComment $annonceComment = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $author = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountAnnonceCommentLikes(): ?int
    {
        return $this->count_annonceCommentLikes;
    }

    public function setCountAnnonceCommentLikes(?int $count_annonceCommentLikes): self
    {
        $this->count_annonceCommentLikes = $count_annonceCommentLikes;

        return $this;
    }

    public function getAnnonceComment(): ?AnnonceComment
    {
        return $this->annonceComment;
    }

    public function setAnnonceComment(?AnnonceComment $annonceComment): self
    {
        $this->annonceComment = $annonceComment;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
