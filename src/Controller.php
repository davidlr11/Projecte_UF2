<?php

    namespace App;

    use App\Request;
    use App\Session;

    class Controller{
        protected $request;
        protected $session;

        function __construct(Request $request, Session $session){
            $this->request=$request;
            $this->session=$session;
            //deactivate errors in next request
            $this->session->unset('error');
        }

        function error(String $str){
            Session::set('error',$str);
        }

        function redirectTo($location){
            if(root()==''){
                $location='/'.$location;
            }else{
                $location=root().$location;
            }
            header('Location:'.root().$location);
        }

       function flash(){
            Session::unset('error');
       }
        
    }