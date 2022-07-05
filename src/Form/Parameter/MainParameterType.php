<?php

namespace App\Form\Parameter;

use App\Entity\Gallery;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainParameterType extends AbstractType
{
    private ParameterTransformer $parameterTransformer;

    public function __construct(ParameterTransformer $parameterTransformer)
    {
        $this->parameterTransformer = $parameterTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('homeGallery', EntityType::class, [
                'placeholder' => 'Select gallery for homepage ...',
                'class' => Gallery::class,
                'choice_label' => 'title',
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