<?php

class CoordinatorController
{
    private $user;
    private $userInfo;

    public function __construct()
    {
        $this->userInfo = new UserInfo();
        $this->user = new User();
    }

    public function index()
    {
        $coordinators = $this->user->getCoordinatorsWithInfo();
        include 'views/admin/coordinator-list.php';
    }
}