<?php

namespace App\Form\Parameter;

use App\Entity\Gallery;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TopbarParameterType extends AbstractType
{
    private ParameterTransformer $parameterTransformer;

    public function __construct(ParameterTransformer $parameterTransformer)
    {
        $this->parameterTransformer = $parameterTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('topbarLogo', FileType::class, [
                'required' => false,
            ])
            ->add('removeTopbarLogo', CheckboxType::class, [
                'required' => false,
                'data' => false,
            ])
            ->add('topbarTitle', TextType::class, [
                'required' => false,
            ]);

        $builder->addModelTransformer($this->parameterTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}