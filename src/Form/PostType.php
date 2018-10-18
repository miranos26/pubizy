<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre", "Titre de l'article"))
            ->add('slug', TextType::class, $this->getConfiguration("URL", "Adresse de l'article (automatique par défaut)", [
                'required' => false
            ]))
            ->add('image', UrlType::class)
            ->add('author', TextType::class, $this->getConfiguration("Auteur", "Auteur de l'article"))
            ->add('content', TextareaType::class, $this->getConfiguration("Contenu", "Contenu de l'article"))
            ->add('category', EntityType::class, [
                'choice_label' => 'title',
                'class' => Category::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
