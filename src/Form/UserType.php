<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, $this->getConfiguration("Prénom", "Prénom"))
            ->add('lastname', TextType::class, $this->getConfiguration("Nom", "Nom"))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "E-mail"))
            ->add('society', TextType::class, $this->getConfiguration("Société", "Société", [
                'required' => false
            ]))
            ->add('phone', TextType::class, $this->getConfiguration("Téléphone", "Téléphone"))
            ->add('hash', PasswordType::class, $this->getConfiguration("Password", "Mot de passe", [
                'required' => false
            ]))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmer le mot de passe", "Confirmer le mot de passe", [
                'required' => false
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
