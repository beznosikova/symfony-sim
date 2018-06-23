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
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductsAdmin extends AbstractAdmin
{
    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->tab('Description')
                ->with(null)
                    ->add('active')
                    ->add('alias')
                    ->add('title')
                    ->add('description')
                    ->add('category.title', null, ['label' => 'Category'])
                    ->add('image')
                ->end()
            ->end()
            ->tab('e-commerce')
                ->with(null)
                    ->add('price')
                    ->add('reserve')
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
                    ->add('alias', TextType::class)
                    ->add('title', TextType::class)
                    ->add('description', TextareaType::class, ['required' => false])
                    ->add('category', ModelType::class, [
                        'class' => Category::class,
                        'property' => 'title',
                    ])
                    ->add('image',
                        'sonata_type_model_list',
                        [],
                        ['link_parameters' => ['context' => 'default']]
                    )
                     ->end()
            ->end()
            ->tab('e-commerce')
                ->with(null)
                    ->add('price', NumberType::class)
                    ->add('reserve', CheckboxType::class, ['required' => false])
                ->end()
            ->end()

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('category', null, [], EntityType::class, [
                'class'    => Category::class,
                'choice_label' => 'title',
                'multiple' => true,
            ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('active', 'boolean', [
                'editable' => true
            ])
            ->addIdentifier('alias')
            ->addIdentifier('title')
            ->add('description')
            ->add('category.title')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
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