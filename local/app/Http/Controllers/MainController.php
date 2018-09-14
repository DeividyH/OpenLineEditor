<?php

namespace OpenLineEditor\Http\Controllers;

use Illuminate\Http\Request;

use OpenLineEditor\Http\Requests;
use OpenLineEditor\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index(){
        return view("index");
    }
    
    public function exportar(){
        return view("exportar");
    }
    
    public function contato(){
        return view("contato");
    }
}
