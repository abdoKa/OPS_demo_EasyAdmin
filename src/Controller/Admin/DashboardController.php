<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
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
        yield MenuItem::linkToCrud('Products', 'far fa-building', Product::class);
        yield MenuItem::linkToCrud('Orders', 'far fa-building', Order::class);
        yield MenuItem::linkToCrud("Order's Product", 'far fa-building', OrderProduct::class);

    }
}
