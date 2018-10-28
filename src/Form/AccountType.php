<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('firstname', TextType::class, $this->getConfiguration("Prénom", "Prénom"))
            ->add('lastname', TextType::class, $this->getConfiguration("Nom", "Nom"))
            ->add('society', TextType::class, $this->getConfiguration("Société", "Société", [
                'required' => false
            ]))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "E-mail"))
            ->add('phone', TextType::class, $this->getConfiguration("Téléphone", "Téléphone"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
