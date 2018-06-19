<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.06.2018
 * Time: 16:18
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Feedback;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FeedbackAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class);
        $formMapper->add('email', EmailType::class);
        $formMapper->add('message', TextareaType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('email');
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('created');
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('email');
        $listMapper->addIdentifier('message');
    }

    public function toString($object)
    {
        return $object instanceof Feedback
            ? $object->getName().' - '.$object->getEmail()
            : 'Feedback';
    }
}