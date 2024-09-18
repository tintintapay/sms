<?php

require_once 'models/UserInfo.php';
require_once 'models/User.php';

class CoordinatorHomeController
{

    public function index()
    {
        
        include "views/coordinator/index.php";
    }

}