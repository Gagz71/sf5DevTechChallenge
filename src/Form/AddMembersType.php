<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddMembersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
		'label' => 'Nom de l\'Argonaute',
	            'attr' => [
	            	'placeholder' => 'Charalampos'
	            ],
	            'constraints' => [
	            	new Length([
	            		'min' => 2,
		                'max' => 50, //Max conseillé par Symfony
		                'minMessage' =>  'Veuillez saisir un nom qui contient au minimum {{ limit }} caractères',
		                'maxMessage' => 'Veuillez saisir un nom qui contient au maximum {{ limit }} caractères',
	                ]),
		            new NotBlank([
			            'message' => 'Veuillez saisir un nom à ajouter'
		            ])
	            ],
            ])
            ->add('submit', SubmitType::class, [
            	'label' => 'Ajouter',
	            'attr' => [
	            	'class' => 'btn-block btn-outline-primary'
	            ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
