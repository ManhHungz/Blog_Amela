<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }

    public function payment(){

    }
}
