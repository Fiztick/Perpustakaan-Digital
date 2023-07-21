<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Book extends BaseController
{
    public function index()
    {
        return view('book/list-buku');
    }

    public function ajax()
    {
        
    }
}
