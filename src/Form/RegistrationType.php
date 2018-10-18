<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, $this->getConfiguration("Nom*", "Votre nom de famille"))
            ->add('firstname', TextType::class, $this->getConfiguration("Prénom*", "Votre prénom", [
                'required' => false
            ]))
            ->add('society', TextType::class, $this->getConfiguration("Société", "Le nom de votre société", [
                'required' => false
            ]))
            ->add('email', EmailType::class, $this->getConfiguration("Email*", "Votre adresse email"))
            ->add('phone', TextType::class, $this->getConfiguration("Téléphone", "Un numéro sur lequel vous contacter", [
                'required' => false
            ]))
            ->add('hash', PasswordType::class, $this->getConfiguration("Password*", "Votre mot de passe"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmation du mot de passe", "Veuillez confirmer votre mot de passe"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
