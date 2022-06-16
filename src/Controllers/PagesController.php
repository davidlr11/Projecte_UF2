<?php

    namespace App\Controllers;


    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;


    class PagesController extends Controller{

        function index(){
            return view('index');
        }
    }