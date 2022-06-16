<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;

    if(!isset($_SESSION)){session_start();} 

class ListController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {

        return view('list');
    }


    public function createList(){
        $name_list= filter_input(INPUT_POST,'name_list');
        $usercreatelist=$_SESSION["username"];
        if (empty($name_list)==false){

            $bbdd=Registry::get('database');
            $sql="INSERT INTO listas(namelist,usercreatelist) VALUES(?,?)";
            $stmt = $bbdd->query($sql);
            $stmt->execute([$name_list,$usercreatelist]);
            
            $this->redirectTo('list');
            
        } else {
            ?>
            <script>
            window.alert("Falta rellenar el campo.");
            location.href='/list';
            </script>
            <?php

        }
        

    }

    }