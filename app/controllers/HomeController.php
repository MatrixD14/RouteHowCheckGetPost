<?php

namespace app\controllers;


class HomeController extends Controllers

{
    public function index()
    {
        return self::view("home");
    }
}
