<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Product')
            ->setEntityLabelInPlural('Products')
            ->setSearchFields(['id', 'name', 'reference', 'description', 'price', 'orderProducts'])
            ->showEntityActionsAsDropdown()
            ;
    }
    public function configureFields(string $pageName): iterable
    {

        $name = TextField::new('name','Product Name ');
        $reference = IntegerField::new('reference', 'Product Reference');
        $description = TextEditorField::new('description','Product Description');
        $price = MoneyField::new('price','price');
        $createdAt = DateTimeField::new('createdAt','Created At: ');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $reference, $description, $price->setCurrency('MAD')->onlyOnDetail(), $createdAt];
        }

        return [
            FormField::addPanel('Product information'),
            $name, $reference, $description,$price->setCurrency('MAD'),
//            FormField::addPanel('createdAt','Created At :'),
//            $createdAt->onlyOnDetail()

        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
            ;
    }
}
