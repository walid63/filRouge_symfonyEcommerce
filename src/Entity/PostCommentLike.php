<?php

namespace App\Entity;

use App\Repository\PostCommentLikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostCommentLikeRepository::class)]
class PostCommentLike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $author = null;

    #[ORM\Column(nullable: true)]
    private ?int $count_PostCommentLike = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    private ?PostComment $postComment = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCountPostCommentLike(): ?int
    {
        return $this->count_PostCommentLike;
    }

    public function setCountPostCommentLike(?int $count_PostCommentLike): self
    {
        $this->count_PostCommentLike = $count_PostCommentLike;

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

    public function getPostComment(): ?PostComment
    {
        return $this->postComment;
    }

    public function setPostComment(?PostComment $postComment): self
    {
        $this->postComment = $postComment;

        return $this;
    }
}
