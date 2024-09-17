<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaginasController extends Controller
{
    public function prestamos(){
        return view("pruebaprestamos");
    }
}
