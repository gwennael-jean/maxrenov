<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use App\Form\MediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@form/admin/collection_entry.form.html.twig')
            ->addFormTheme('@form/media.form.html.twig')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm()
            ->hideOnIndex();

        yield FormField::addTab('Main');

        yield TextField::new('icon')
            ->setColumns('col-12')
            ->hideOnIndex()
            ->setHelp("Icon name from http://fontawesome.com");

        yield TextField::new('title')
            ->setColumns('col-12');

        yield TextField::new('description')
            ->setColumns('col-12');
        yield FormField::addTab('Media');

        yield CollectionField::new('medias')
            ->setEntryType(MediaType::class)
            ->setFormTypeOption('entry_options', [
                'required' => true,
                'block_prefix' => 'custom_collection_entry',
            ])
            ->allowAdd()
            ->allowDelete();
    }
}
