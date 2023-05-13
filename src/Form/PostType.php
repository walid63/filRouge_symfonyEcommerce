<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('title',TextType::class,['label' => 'Titre','attr' => ['class'=>'form-control']]) //titre  = author
            ->add('content',TextareaType::class,['attr' => ['class'=>'form-control','cols' => '150', 'rows' => '15','maxlength' => "50"]])
           // ->add('createdAt')
           // ->add('count_like')
           // ->add('slug')
           // ->add('author')
           // ->add('likes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
