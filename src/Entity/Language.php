<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LanguageRepository::class)
 */
class Language
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity=Expression::class, mappedBy="expression_language", orphanRemoval=true)
     */
    private $expressions;

    public function __construct()
    {
        $this->expressions = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection|Expression[]
     */
    public function getExpressions(): Collection
    {
        return $this->expressions;
    }

    public function addExpression(Expression $expression): self
    {
        if (!$this->expressions->contains($expression)) {
            $this->expressions[] = $expression;
            $expression->setExpressionLanguage($this);
        }

        return $this;
    }

    public function removeExpression(Expression $expression): self
    {
        if ($this->expressions->removeElement($expression)) {
            // set the owning side to null (unless already changed)
            if ($expression->getExpressionLanguage() === $this) {
                $expression->setExpressionLanguage(null);
            }
        }

        return $this;
    }


    /**
     * Get the value of languageList
     */ 
    public function getLanguageList()
    {
        return $this->languageList;
    }

    /**
     * Set the value of languageList
     *
     * @return  self
     */ 
    public function setLanguageList($languageList)
    {
        $this->languageList = $languageList;

        return $this;
    }


    public function __toString()
    {
        return $this->name;
    }

}
