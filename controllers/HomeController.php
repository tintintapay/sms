<?php

class HomeController
{
    public function index()
    {
        include 'views/index.php';
    }

    public function about()
    {
        include 'views/about.php';
    }

    public function sport()
    {
        include 'views/sport.php';
    }

    public function contact()
    {
        include 'views/contact.php';
    }

    public function faqs()
    {
        include 'views/faqs.php';
    }

    public function terms()
    {
        include 'views/terms.php';
    }
}