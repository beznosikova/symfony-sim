<?php
namespace AppBundle\Admin;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OrderSimAdmin extends AbstractAdmin
{
    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->tab('Description')
            ->with(null)
            ->add('active')
            ->add('done')
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('created')
            ->add('notes')
            ->end()
            ->end()
            ->tab('Delivery')
            ->with(null)
            ->add('delivery')
            ->add('postIndex')
            ->add('city')
            ->add('address')
            ->add('deliveryPrice')
            ->end()
            ->end()
            ->tab('Products')
            ->with(null)
            ->add('list')
            ->add('productsPrice')
            ->end()
            ->end()
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Description')
                ->with(null)
                    ->add('active', CheckboxType::class, ['required' => false])
                    ->add('done', CheckboxType::class, ['required' => false])
                    ->add('firstName', TextType::class, ['disabled' => true])
                    ->add('lastName', TextType::class, ['disabled' => true])
                    ->add('email', TextType::class, ['disabled' => true])
                    ->add('phone', TextType::class, ['disabled' => true])
                    ->add('created', DateTimeType::class, ['disabled' => true])
                    ->add('notes', TextareaType::class, ['required' => false])
                ->end()
            ->end()
            ->tab('Delivery')
                ->with(null)
                    ->add('delivery', TextType::class)
                    ->add('postIndex', TextType::class)
                    ->add('city', TextType::class)
                    ->add('address', TextType::class)
                    ->add('deliveryPrice', NumberType::class)
            ->end()
            ->end()
            ->tab('Products')
                ->with(null)
                    ->add('list', TextareaType::class, ['disabled' => true])
                    ->add('productsPrice', NumberType::class)
                ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('active')
            ->add('done')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('active', 'boolean', [
                'editable' => true
            ])
            ->add('done', 'boolean', [
                'editable' => true
            ])
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('phone')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'delete' => [],
                ]
            ])
        ;
    }

    public function toString($object)
    {
        return $object instanceof Product
            ? $object->getTitle()
            : 'Product'; // shown in the breadcrumb on the create view
    }
}