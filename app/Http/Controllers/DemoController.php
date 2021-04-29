<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function userDemo() {
        return view('user');
    }
    
    public function adminDemo() {
        return view('admin');
    }
    
    public function permisionDenied() {
        return view('nopermission');
    }
    
}
