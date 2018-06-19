<?php
namespace AppBundle\Admin;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductsAdmin extends AbstractAdmin
{
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
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('active')
            ->addIdentifier('alias')
            ->addIdentifier('title')
            ->addIdentifier('description')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Product
            ? $object->getTitle()
            : 'Product'; // shown in the breadcrumb on the create view
    }
}