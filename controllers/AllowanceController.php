<?php

class AllowanceController
{

    public function index()
    {
        $allowances = $this->allowance->fetchAll();

        return include 'views/admin/allowances.php';
    }
}