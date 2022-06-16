<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Request;
    use App\Session;


    if(!isset($_SESSION)){session_start();} 

class VisualizarAsignaturasController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {

        return view('visualizarasignaturas');
    }

    }