<?php
namespace AppBundle\Admin;

use AppBundle\Entity\Page;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PageAdmin extends AbstractAdmin
{
    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->tab('Description')
                ->with(null)
                    ->add('active', 'boolean')
                    ->add('main_page', 'boolean')
                    ->add('alias')
                    ->add('title')
                    ->add('description', 'html')
                    ->add('sort')
                ->end()
            ->end()
            ->tab('SEO')
                ->with(null)
                    ->add('seo_description')
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
                    ->add('main_page', CheckboxType::class, ['required' => false])
                    ->add('alias', TextType::class)
                    ->add('title', TextType::class)
                    ->add('description', CKEditorType::class, ['required' => false])
                    ->add('sort', NumberType::class)
                ->end()
            ->end()
            ->tab('SEO')
                ->with(null)
                    ->add('seo_description', TextType::class)
                ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('alias')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('active', 'boolean', [
                'editable' => true
            ])
            ->add('main_page', 'boolean', [
                'editable' => true
            ])
            ->add('sort')
            ->addIdentifier('alias')
            ->addIdentifier('title')
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
        return $object instanceof Page
            ? $object->getTitle()
            : 'Page';
    }
}