<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;

class IndexController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {
        //$users = Registry::get('database')->selectAll('usuarios');
        return view('index'/*, compact('usuarios')*/);
    }

    }