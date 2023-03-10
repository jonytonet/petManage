<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class CustomersController extends Controller
{
    public function index()
    {
        return view('customers.index');
    }
}
