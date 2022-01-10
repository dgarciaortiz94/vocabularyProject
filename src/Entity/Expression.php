<?php

namespace App\Entity;

use App\Repository\ExpressionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpressionRepository::class)
 */
class Expression
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $translation;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="expressions")
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=Language::class, inversedBy="expressions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $expression_language;

    /**
     * @ORM\ManyToOne(targetEntity=Language::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $translation_language;

    /**
     * @ORM\Column(type="datetime")
     */
    private $searchDate;

    private $multipleTranslations = [];

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTranslation(): ?string
    {
        return $this->translation;
    }

    public function setTranslation(string $translation): self
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id[] = $userId;
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        $this->user_id->removeElement($userId);

        return $this;
    }

    public function getExpressionLanguage(): ?Language
    {
        return $this->expression_language;
    }

    public function setExpressionLanguage(?Language $expression_language): self
    {
        $this->expression_language = $expression_language;

        return $this;
    }

    public function getTranslationLanguage(): ?Language
    {
        return $this->translation_language;
    }

    public function setTranslationLanguage(?Language $translation_language): self
    {
        $this->translation_language = $translation_language;

        return $this;
    }

    public function getSearchDate(): ?\DateTimeInterface
    {
        return $this->searchDate;
    }

    public function setSearchDate(\DateTimeInterface $searchDate): self
    {
        $this->searchDate = $searchDate;

        return $this;
    }


    /**
     * Get the value of multipleTranslations
     */ 
    public function getMultipleTranslations()
    {
        return $this->multipleTranslations;
    }

    /**
     * Set the value of multipleTranslations
     *
     * @return  self
     */ 
    public function setMultipleTranslations(array $multipleTranslations)
    {
        $this->multipleTranslations = $multipleTranslations;

        return $this;
    }

    /**
     * Set the value of multipleTranslations
     *
     * @return  self
     */ 
    public function addMultipleTranslations(string $translation)
    {
        array_push($this->multipleTranslations, $translation);

        return $this;
    }
}
