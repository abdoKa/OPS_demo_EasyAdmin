<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Entity\OrderProduct;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(CustomerCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('OPS Order Proccessing System')
            ->setFaviconPath('/images/icons8-services-64.png')


        ;

    }

    public function configureMenuItems(): iterable

    {
        yield MenuItem::section('OPS');
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Customers', 'far fa-building', Customer::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-boxes', Category::class);
        yield MenuItem::linkToCrud('Products', 'fab fa-product-hunt', Product::class);
        yield MenuItem::linkToCrud('Orders', 'fas fa-boxes', Order::class);






    }
}
