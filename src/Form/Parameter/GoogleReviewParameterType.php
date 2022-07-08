<?php

namespace App\Form\Parameter;

use App\Entity\Gallery;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoogleReviewParameterType extends AbstractType
{
    private ParameterTransformer $parameterTransformer;

    public function __construct(ParameterTransformer $parameterTransformer)
    {
        $this->parameterTransformer = $parameterTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('googleReviewAPIKey', TextType::class, [
                'label' => 'Google review API key',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Set your API key ...',
                ],
            ])
            ->add('googleReviewPlaceId', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Set your place ID ...',
                ],
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