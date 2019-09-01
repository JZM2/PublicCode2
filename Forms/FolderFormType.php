<?php
namespace App\Forms;

use App\Entity\Folder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class FolderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
				->add('foldername', TextType::class, ['constraints' => [new NotBlank(['message'=>"Prosím zadejte název složky!"])], 'label' => 'Název složky', 'attr' => ['maxlength' => 150, 'size' => 50]])
				->add('folderqth', TextType::class, ['label' => 'QTH', 'attr' => ['maxlength' => 150, 'size' => 50]])
				->add('foldergrid', TextType::class, ['label' => 'Grid (lokátor)', 'attr' => ['maxlength' => 10, 'size' => 10]])
				->add('FolderGps', TextType::class, ['label' => 'GPS', 'attr' => ['maxlength' => 50, 'size' => 40]])
				->add('foldercontest', TextType::class, ['label' => 'contest (závod)', 'attr' => ['maxlength' => 150, 'size' => 50]])
				->add('foldercontestfrom', DateTimeType::class, ['label' => 'termín od'])
				->add('foldercontestto', DateTimeType::class, ['label' => 'termín do'])
				->add('foldercontestcat', TextType::class, ['label' => 'kategorie závodu', 'attr' => ['maxlength' => 150, 'size' => 50]])
				->add('foldertx', TextType::class, ['label' => 'tranceiver', 'attr' => ['maxlength' => 150, 'size' => 30]])
				->add('foldertx_power', NumberType::class, ['label' => 'vysílací výkon', 'attr' => ['maxlength' => 4, 'size' => 6]])
				->add('foldertx_ant', TextType::class, ['label' => 'anténa', 'attr' => ['maxlength' => 150, 'size' => 30]])
				->add('folderrx', TextType::class, ['label' => 'receiver (přijímač)', 'attr' => ['maxlength' => 150, 'size' => 30]])
				->add('folderremarks', TextareaType::class, ['label' => 'poznámka', 'attr' => ['maxlength' => 4000, 'style' => 'width:20vw; height: 5vh;'], 'required' => false ])
				->add('save', SubmitType::class, ['label' => 'Uložit složku'])
				->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Folder::class,
        ]);
    }
}

