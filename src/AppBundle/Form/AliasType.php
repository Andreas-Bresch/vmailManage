<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 07.07.17
 * Time: 21:32
 */

namespace AppBundle\Form;

use AppBundle\Entity\Domain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AliasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('source_username', TextType::class)
            ->add('source_domain', EntityType::class, array(
                'class' => 'AppBundle:Domain',
                'choice_label' => 'domain',
                'placeholder' => 'Choose a domain',
            ))
            ->add('destination_username', TextType::class)
            ->add('destination_domain', TextType::class)
            ->add('enabled', CheckboxType::class)
            ->add('save', SubmitType::class, array('label' => 'submit'))
        ;
    }
}