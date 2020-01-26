<?php
namespace AppBundle\Form;


use AppBundle\Entity\Movie;
use AppBundle\Entity\Room;
use AppBundle\Entity\Showing;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowingForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
                'format' => 'dd-MM-yyyy hh:ii',
            ])
            ->add('is3D', CheckboxType::class, [
                "label" => "3D ?",
                'required' => false
            ])
            ->add('movie', EntityType::class, [
                "class" => Movie::class,
                'choice_label' => 'title'
            ])
            ->add('room', EntityType::class, [
                "class" => Room::class,
                'choice_label' => function (Room $room) {
                    return $room->toString();
                }
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Showing::class,
        ));
    }
}