<?php
class logoutController extends controller 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
        session_destroy();
        header("Location: ".BASE_URL);
    }
}
