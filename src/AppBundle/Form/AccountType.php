<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 02.07.17
 * Time: 23:36
 */

namespace AppBundle\Form;

use AppBundle\Entity\Account;
use AppBundle\Entity\Domain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class AccountType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('domain', EntityType::class, array(
                'class' => 'AppBundle:Domain',
                //'data_class' => Domain::class,
                'choice_label' => 'domain',
                //'choice_value' => 'domain',
                'placeholder' => 'Choose domain',
                // 'data' => $options['domain']

                ))
            ->add('password', TextType::class)
            ->add('quota', IntegerType::class)
            ->add('enabled', CheckboxType::class)
            ->add('sendonly', CheckboxType::class)
            ->add('save', SubmitType::class, array('label' => 'submit'))
        ;
    }

}