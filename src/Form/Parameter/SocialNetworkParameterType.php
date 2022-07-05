<?php

namespace App\Form\Parameter;

use App\Entity\Gallery;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocialNetworkParameterType extends AbstractType
{
    private ParameterTransformer $parameterTransformer;

    public function __construct(ParameterTransformer $parameterTransformer)
    {
        $this->parameterTransformer = $parameterTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('twitter', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Set your twitter account ...',
                ],
                'help' => 'Example : in the https://twitter.com/XYZ, your account is XYZ',
            ])
            ->add('facebook', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Set your facebook account ...',
                ],
                'help' => 'Example : in the https://www.facebook.com/XYZ, your account is XYZ',
            ])
            ->add('instagram', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Set your instagram account ...',
                ],
                'help' => 'Example : in the https://www.instagram.com/XYZ, your account is XYZ',
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