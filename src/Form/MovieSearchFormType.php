<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MovieSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['mapped' => false])
            ->add('page', IntegerType::class, ['mapped' => false, 'data' => 1])
            ->add('select_api', ChoiceType::class, [
                'choices'  => [
                    'omdb'       => 'omdb',
                    'themoviedb' => 'themoviedb',
                ],
            ])
            ->add('search', SubmitType::class);
    }
}