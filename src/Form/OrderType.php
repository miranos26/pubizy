<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfiguration("Titre", "Intitulé de la commande"))
            ->add('clientName', TextType::class, $this->getConfiguration("Client", "Nom du Client"))
            ->add('clientEmail', EmailType::class, $this->getConfiguration("Email", "Contact client"))
            ->add('status', TextType::class, $this->getConfiguration("Statut", "Statut de la commande"))
            ->add('price', IntegerType::class, $this->getConfiguration("Prix", "Tarif de la commande"))
            ->add('createdAt', DateType::class, $this->getConfiguration("Date de début", "Date de début du projet"))
            ->add('deliveryAt', DateType::class, $this->getConfiguration("Date de fin", "Date de livraison estimée"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
