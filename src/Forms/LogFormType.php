<?php
namespace App\Forms;

use App\Entity\Log;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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

class LogFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
				//->add('folderid', HiddenType::class ,[])
				//->add('id', HiddenType::class,[])
				->add('logmynum', NumberType::class, ['constraints' => [new NotBlank(['message'=>"Prosím zadejte číslo spojení!"])], 'label' => 'číslo spojení', 'attr' => ['maxlength' => 4, 'size' => 5]])
				->add('logdate', DateTimeType::class, ['label' => 'datum (seč)', 'attr' => ['style' => 'width: 200px;', 'size' => 100]])
				->add('logCall', TextType::class, ['label' => 'volací znak', 'attr' => ['maxlength' => 12, 'size' => 20]])
				->add('logFrequency', NumberType::class, ['label' => 'frekvence', 'attr' => ['maxlength' => 12, 'size' => 20]])
				->add('logMode', TextType::class, ['label' => 'mód', 'attr' => ['maxlength' => 150, 'size' => 10]])

				->add('logyourst', NumberType::class, ['constraints' => [new NotBlank(['message'=>"Prosím zadejte hodnotu reportu!"])], 'label' => 'RST on', 'attr' => ['maxlength' => 4, 'size' => 5]])
				
				->add('logyouqsl', ChoiceType::class, ['label' => 'QSL protistanice', 'attr' => ['maxlength' => 50, 'size' => 1],'required'   => false, 'empty_data' => 'NEPOŽADOVÁN','choices'  => [
					'NEPOŽADOVÁN' => 'NEPOŽADOVÁN',
					'POŽADOVÁN' => 'POŽADOVÁN',
					'ODESLÁN' => 'ODESLÁN',
					'PŘIJAT' => 'PŘIJAT',
					],])
				
				
				->add('logYouQslManager', TextType::class, ['label' => 'QSL manager protistanice', 'attr' => ['maxlength' => 150, 'size' => 20],'required'   => false,])
				->add('logYouGrid', TextType::class, ['label' => 'GRID protistanice', 'attr' => ['maxlength' => 10, 'size' => 12],'required'   => false,])
				->add('logYouDxcc', TextType::class, ['label' => 'DXCC', 'attr' => ['maxlength' => 6, 'size' => 10],'required'   => false,])
				->add('logYouIota', TextType::class, ['label' => 'IOTA', 'attr' => ['maxlength' => 6, 'size' => 10], 'required'   => false])
				->add('logYouQth', TextType::class, ['label' => 'QTH protistanice', 'attr' => ['maxlength' => 255, 'size' => 30],'required'   => false,])
				->add('logYouContest', TextType::class, ['label' => 'Contest string protistanice', 'attr' => ['maxlength' => 255, 'size' => 20],'required'   => false,])
				
				->add('logmyrst', NumberType::class, ['constraints' => [new NotBlank(['message'=>"Prosím zadejte hodnotu reportu!"])], 'label' => 'RST já', 'attr' => ['maxlength' => 4, 'size' => 5]])
				->add('logMyContest', TextType::class, ['label' => 'Contest string já', 'attr' => ['maxlength' => 255, 'size' => 20],'required'   => false,])
				->add('logMyQsl', ChoiceType::class, ['label' => 'QSL já', 'attr' => ['maxlength' => 50, 'size' => 1],'required'   => false, 'empty_data' => 'NEPOŽADOVÁN','choices'  => [
					'NEPOŽADOVÁN' => 'NEPOŽADOVÁN',
					'POŽADOVÁN' => 'POŽADOVÁN',
					'ODESLÁN' => 'ODESLÁN',
					'PŘIJAT' => 'PŘIJAT',
					],])
				
				->add('logpoints', NumberType::class, ['constraints' => [new NotBlank(['message'=>"Prosím zadejte počet bodů!"])], 'label' => 'bodů:', 'attr' => ['maxlength' => 4, 'size' => 5],'required' => false, 'empty_data' => 0])
				
				->add('logremarks', TextareaType::class, ['label' => 'poznámka', 'attr' => ['maxlength' => 4000, 'style' => 'width:20vw; height: 5vh;'], 'required' => false ])
				->add('save', SubmitType::class, ['label' => 'Uložit', 'attr' => ['class' => 'ui-state-default']])
				->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Log::class,
        ]);
    }
}

