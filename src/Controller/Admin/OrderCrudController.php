<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Order')
            ->setEntityLabelInPlural('Orders')
//            ->setSearchFields(['name', 'reference', 'description', 'price'])
            ->showEntityActionsAsDropdown()
            ;
    }
    public function configureFields(string $pageName): iterable
    {

        $deliveryAt = DateField::new('deliveryAt','Delivery Date ');
        $customer = AssociationField::new('clientId', 'Customer');

        $products = AssociationField::new('products');
        $quantity = IntegerField::new('quantity','Customer\'s Quantity');


        if (Crud::PAGE_INDEX === $pageName) {
            return [$deliveryAt, $customer, $products,$quantity];
        }

        return [
            FormField::addPanel('Order information'),
            $deliveryAt,$customer,$quantity,

            FormField::addPanel('Order\'s Product information'),
            $products,
            FormField::addPanel('createdAt','Created At :')->hideOnForm(),
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

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
