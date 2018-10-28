<?php

namespace App\Form;

use App\Entity\Quotation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuotationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfiguration("Nom*", "Votre nom"))
            ->add('lastName', TextType::class, $this->getConfiguration("Prénom*", "Votre prénom"))
            ->add('phone', TextType::class, $this->getConfiguration("Téléphone*", "Votre numéro de téléphone"))
            ->add('email', EmailType::class, $this->getConfiguration("Email professionnel*", "Votre email"))
            ->add('product', ChoiceType::class, array(
                'choices' => array(
                    'Logo & identité' => 'Logo & identité',
                    'Support de communication imprimé' => 'Support de communication',
                    'Création de site internet' => 'Création de site internet',
                    'Marketing digital' => 'Marketing digital',
                    'Infographie' => 'Infographie',
                    '3D & Vidéo' => '3D & Vidéo',
                    'Execution graphique' => 'Execution Graphique',
                    'Accessoires publicitaires' => 'Accessoires publicitaires',
                    'Vêtements publicitaires' => 'Impression textile',
                    'Stand & evenementiel' => 'Stand & evenementiel',
                ),
            ))
            ->add('print_subproduct', ChoiceType::class, array(
                'choices' => array(
                    'Flyers' => 'Flyers',
                    'Cartes de visite' => 'Cartes de visite',
                    'faire-part' => 'faire-part',
                    'Affiches' => 'Affiches',
                    'Brochure / Plaquette / Dépliant' => 'Brochure / Plaquette / Dépliant',
                    'Adhésif vinyle' => 'Adhésif vinyle',
                    'Stickers sur mesure' => 'Stickers sur mesure',
                    'Autocollant' => 'Autocollant',
                    'Etiquettes' => 'Etiquettes',
                    'Calendrier / Agenda' => 'Calendrier / Agenda',
                    'Papier à en-tête' => 'Papier à en-tête',
                    'Menu' => 'Menu',
                    'Set de table' => 'Set de table',
                    'Kakémono' => 'Kakémono',
                    'Drapeau' => 'Drapeau'
                ),
            ))

            ->add('web_subproduct', ChoiceType::class, array(
                'choices' => array(
                    'Site vitrine simple' => 'Site vitrine simple',
                    'Site vitrine avec système d\'administration' => 'Site vitrine avec système d\'administration',
                    'Site e-commerce' => 'Site e-commerce',
                    'Prestation de référencement' => 'prestation de référencement',
                    'Modernisation d\'un site existant' => 'Modernisation d\'un site existant',
                    'Newsletter' => 'Newsletter',
                ),
            ))
            ->add('object_subproduct', ChoiceType::class, array(
                'choices' => array(
                    'Caisson lumineux' => 'Caisson lumineux',
                    'Revêtement de sol (lino ou moquette) publicitaire' => 'Revêtement de sol (lino ou moquette) publicitaire',
                    'Calendrier/agenda' => 'Calendrier/agenda',
                    'Tampon' => 'Tampon',
                    'Dessous de verre' => 'Dessous de verre',
                    'Set de table' => 'Set de table',
                    'Menu restaurant' => 'Menu restaurant',
                    'Sac papier publicitaire' => 'Sac papier publicitaire',
                    'Présentoir' => 'Présentoir',
                    'Lettre et logo 3D PVC' => 'Lettre et logo 3D PVC',
                    'Stylos publicitaire' => 'Stylos publicitaire',
                    'Clef USB publicitaire' => 'Clef USB publicitaire',
                    'Tasse publicitaire' => 'Tasse publicitaire',
                    'Autre...' => 'Autre...',
                ),
            ))
            ->add('textile_subproduct', ChoiceType::class, array(
                'choices' => array(
                    'T-shirt' => 'T-shirt',
                    'Polo' => 'Polo',
                    'Casquette' => 'Casquette',
                    'Chemise' => 'Chemise',
                    'Veste' => 'Veste',
                    'Gilet' => 'Gilet',
                    'Parapluie' => 'Parapluie',
                    'Sac à dos' => 'Sac à dos',
                    'Sac en toile' => 'Sac en toile',
                    'Autre...' => 'Autre...',
                ),
            ))
            ->add('evenementiel_subproduct', ChoiceType::class, array(
                'choices' => array(
                    'Roll-up' => 'Roll-up',
                    'Bannière' => 'Bannière',
                    'Afficheur Multimédia' => 'Afficheur Multimédia',
                    'Kakemono' => 'Kakemono',
                    'Drapeau' => 'Drapeau',
                    'Stand' => 'Stand',
                    'Totem' => 'Totem',
                    'Tour de cou' => 'Tour de cou',
                    'Billet/Badge/Identification' => 'Billet/Badge/Identification',
                    'Textile' => 'Textile',
                    'Revêtement de sol' => 'Revêtement de sol',
                    'Autre...' => 'Autre...',
                ),
            ))
            ->add('marketing_subproduct', ChoiceType::class, array(
                'choices' => array(
                    'Publicité Facebook / Twitter / Instagram' => 'Publicité Facebook / Twitter / Instagram',
                    'Canvas Facebook / Instagram' => 'Canvas Facebook / Instagram',
                    'Visuel pour réseaux sociaux' => 'Visuel pour réseaux sociaux',
                    'Référencement SEO' => 'Référencement SEO',
                    'Campagne Adwords' => 'Campagne Adwords',
                    'Outil de suivi du traffic web' => 'Outil de suivi du traffic web',
                    'Autre...' => 'Autre...',
                ),
            ))
            ->add('motion_subproduct', ChoiceType::class, array(
                'choices' => array(
                    'Montage vidéo' => 'Montage vidéo',
                    'Modification sur vidéo' => 'Modification sur vidéo',
                    'Motion design / Vidéo animée de présentation' => 'Motion design / Vidéo animée de présentation',
                    'Motion design 3D' => 'Motion design 3D',
                    'Autre...' => 'Autre...',
                ),
            ))
            ->add('infographic_subproduct', ChoiceType::class, array(
                'choices' => array(
                    'Illustration' => 'Illustration',
                    'Infographie' => 'Infographie',
                    'Modélisation 3D' => 'Modélisation 3D',
                    'Imagerie 3D photoréaliste' => 'Imagerie 3D photoréaliste',
                ),
            ))
            ->add('exe_subproduct', ChoiceType::class, array(
                'choices' => array(
                    'Adaptation d\'un document sur un autre format' => 'Adaptation d\'un document sur un autre format',
                    'Détourage photo' => 'Détourage photo',
                    'Montage photo' => 'Montage photo',
                    'Retouche photo' => 'Retouche photo',
                    'Vectorisation' => 'Vectorisation',
                    'Autre...' => 'Autre...',
                ),
            ))
            ->add('quantity', NumberType::class, [
                'required' => false
            ])

            ->add('delay', ChoiceType::class, array(
                'choices' => array(
                    'Dès que possible' => 'Dès que possible',
                    '4 jours' => '4 jours',
                    '1 semaine' => '1 semaine',
                    '2 semaines' => '2 semaines',
                    'Je ne sais pas encore' => 'Je ne sais pas encore',
                ),
            ))
            ->add('activityArea', ChoiceType::class, array(
                'choices' => array(
                    'Agroalimentaire' => 'Agroalimentaire',
                    'Artisan / Commerçant' => 'Artisan / Commerçant',
                    'BTP / Matériaux de construction' => 'BTP / Matériaux de construction',
                    'Banque / Assurance' => 'Banque / Assurance',
                    'Chimie / Parachimie' => 'Chimie / Parachimie',
                    'E-commerce / Startup' => 'E-commerce / Startup',
                    'Communication / Média' => 'Communication / Média',
                    'Electronique' => 'Electronique',
                    'Etude et conseil' => 'Etude et conseil',
                    'Industrie' => 'Industrie',
                    'Informatique / Télécoms' => 'Informatique / Télécoms',
                    'Machine et équipement / Automobile' => 'Machine et équipement / Automobile',
                    'Services aux entreprises' => 'Services aux entreprises',
                    'Mode / Textile' => 'Mode / Textile',
                    'Transport / Logistique / Distribution' => 'Transport / Logistique / Distribution',
                    'Autre' => 'Autre',
                ),
            ))
            ->add('description', TextareaType::class, $this->getConfiguration("Description", "Exemple : J'ai besoin d'un logo pour ma nouvelle entreprise.",[
                'required' => false
            ]))
            ->add('reference', FileType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quotation::class,
            'attr' => ['id' => 'msform'],
        ]);
    }
}
