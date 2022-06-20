<?php

namespace App\Controller\Admin\Node;

use App\Entity\Node\Page;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Action::DETAIL === $pageName) {
            yield IdField::new('id');
        }

        yield TextField::new('title');

        if (in_array($pageName, [Action::NEW, Action::EDIT])) {
            yield SlugField::new('slug')
                ->setTargetFieldName('title');

            yield TextEditorField::new('body');
        }
    }
}
