<?php

namespace app\controllers;

class ContactController extends Controllers
{
    public function index()
    {
        return self::view('contact');
    }

    public function store()
    {
        return self::view('store');
    }
}
