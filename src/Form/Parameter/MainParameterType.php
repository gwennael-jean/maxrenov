<?php

namespace App\Form\Parameter;

use App\Entity\Gallery;
use App\Form\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('homeJumbotronBackground', FileType::class, [
                'required' => false,
            ])
            ->add('homeJumbotronTitleImage', FileType::class, [
                'required' => false,
            ])
            ->add('removeHomeJumbotronTitleImage', CheckboxType::class, [
                'required' => false,
                'data' => false,
            ])
            ->add('homeJumbotronTitle', TextType::class, [
                'required' => true,
            ])
            ->add('homeJumbotronSubtitle', TextType::class, [
                'required' => false,
            ])
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