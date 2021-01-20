<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Customer')
            ->setEntityLabelInPlural('Customers')
            ->setSearchFields([ 'name', 'email', 'country', 'address', 'zipCode', 'CCI', 'phone'])
            ->showEntityActionsAsDropdown()
    ;
    }

    public function configureFields(string $pageName): iterable
    {
        $blocked = BooleanField::new('blocked','Blocked');

        $name = TextField::new('name','Company ');
        $email = EmailField::new('email', 'Email');
        $country = CountryField::new('country','Country');
        $address = TextareaField::new('address','Address');
        $zipCode = IntegerField::new('zipCode','Zip Code');
        $CCI = IntegerField::new('CCI','CCI ');
        $phone = TelephoneField::new('phone','Phone');
        $website = UrlField::new('website', 'Website');
        $createdAt = DateTimeField::new('createdAt','Created At: ')->hideOnForm();

        if (Crud::PAGE_INDEX === $pageName) {
            return [$blocked,$name, $email, $country, $address,$zipCode,$CCI,$phone,$website, $createdAt->setFormat('short', 'short')];
        }

        return [
            FormField::addPanel('Company Contact information'),
            $blocked->hideOnForm(), $name, $email, $phone,$website,
            FormField::addPanel('Company Based'),
            $address, $zipCode,$country,
            FormField::addPanel('Common Company Identifier '),
            $CCI,
            FormField::addPanel('createdAt','Created At :')->hideOnForm(),
            $createdAt

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
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('email')
            ->add('CCI')
            ->add('country')
            ;
    }


}
