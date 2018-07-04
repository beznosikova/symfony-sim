<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderSimType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('phone')
            ->add('postIndex')
            ->add('city')
            ->add('address')
            ->add('notes')
            ->add('list')
            ->add('productsPrice')
            ->add('deliveryPrice')
            ->add('delivery', ChoiceType::class, [
                'choices' => [
                    1 => 'Укрпочта - рекомендованное письмо',
                    2 => 'Новая почта - оплата на карточку',
                    3 => 'Новая почта - наложенный платеж - опалата при получении',
                ]])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\OrderSim'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ordersim';
    }
}