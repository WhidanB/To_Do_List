<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('due_date')
            ->add('added_by')
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'A faire' => 'A faire',
                    'En cours' => 'En cours',
                    'Terminée' => 'Terminée',
                ],
            ])
            ->add('priority', ChoiceType::class, [
                'choices'  => [
                    'Urgent' => 'Urgent',
                    'Medium' => 'Medium',
                    'Low' => 'Low',
                ],
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
