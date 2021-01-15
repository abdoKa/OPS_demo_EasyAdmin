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

//            $deliveryAt = DateField::new('deliveryAt', 'Delivery Date');
//            $customer = AssociationField::new('clientId','Company Name');
//            $prodcut = CollectionField::new('orderProducts','Products');



        yield  DateField::new('deliveryAt', 'Delivery Date');

        yield AssociationField::new('clientId','Company Name');



//        if (Crud::PAGE_INDEX === $pageName) {
//            return [$deliveryAt, $customer, $prodcut ];
//        }
//
//        return [
//            FormField::addPanel('Order information'),
//            $deliveryAt, $customer, $prodcut
//
//
//
//        ];
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
