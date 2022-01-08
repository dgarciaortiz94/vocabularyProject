<?php

namespace App\Entity;

use App\Repository\UserOptionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserOptionsRepository::class)
 */
class UserOptions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="userOptions", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\OneToOne(targetEntity=Language::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $native_language;

    /**
     * @ORM\OneToOne(targetEntity=Language::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $language_to_learn;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getNativeLanguage(): ?Language
    {
        return $this->native_language;
    }

    public function setNativeLanguage(Language $native_language): self
    {
        $this->native_language = $native_language;

        return $this;
    }

    public function getLanguageToLearn(): ?Language
    {
        return $this->language_to_learn;
    }

    public function setLanguageToLearn(Language $language_to_learn): self
    {
        $this->language_to_learn = $language_to_learn;

        return $this;
    }
}
