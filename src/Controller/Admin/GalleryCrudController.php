<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use App\Form\MediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GalleryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gallery::class;
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
        yield TextField::new('title')
            ->setColumns('col-12');

        yield CollectionField::new('medias')
            ->setEntryIsComplex()
            ->setEntryType(MediaType::class)
            ->setFormTypeOption('entry_options', [
                'required' => true,
                'block_prefix' => 'custom_collection_entry',
            ])
            ->allowAdd()
            ->allowDelete();
    }
}
