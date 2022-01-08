<?php

namespace App\Form;

use App\Entity\Expression;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpressionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // $name = $builder->getData()->getTranslationLanguage()->getName();
        // $code = $builder->getData()->getTranslationLanguage()->getCode();

        // var_dump($name);
        // echo "<br><br>";
        // var_dump($code);
        // die;

        $builder
            ->add('name')
            ->add('translation')
            ->add('expression_language', ChoiceType::class, [
                "choices" => [
                    $builder->getData()->getExpressionLanguage()->getName() => $builder->getData()->getExpressionLanguage(),
                    $builder->getData()->getTranslationLanguage()->getName() => $builder->getData()->getTranslationLanguage(),
                ],
                
            ])
            ->add('translation_language', ChoiceType::class, [
                "choices" => [
                    $builder->getData()->getTranslationLanguage()->getName() => $builder->getData()->getTranslationLanguage(),
                    $builder->getData()->getExpressionLanguage()->getName() => $builder->getData()->getExpressionLanguage(),
                ],
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Expression::class,
        ]);
    }
}
