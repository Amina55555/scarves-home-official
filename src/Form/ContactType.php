<?php

namespace App\Form;


use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class,[
              'attr' => ['placeholder'=>'Votre Nom', 
                          ]
          ])
            ->add('lastname', TextType::class,[
              'attr' => ['placeholder'=>'Votre Prénom', 
                          ]
          ])
            ->add('email', EmailType::class,[
              'attr' => ['placeholder'=>'Votre adresse email', 
                          ]
          ])
            ->add('object', TextType::class,[
                'attr' => ['placeholder'=>'Objet de votre email', 
                            ]
            ])
            ->add('message', TextareaType::class,[
              'attr' => ['placeholder'=>'Votre Message', 
                          'rows'=> 5
                          ]
          ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
