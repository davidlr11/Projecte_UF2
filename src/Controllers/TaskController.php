<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;

class TaskController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {

        return view('task');
    }


    public function createTask(){
        $nametask= filter_input(INPUT_POST,'name_task');
        $descriptiontask= filter_input(INPUT_POST,'description_task');
        $usercreatelist=$_SESSION["username"];
        $idtasklist=filter_input(INPUT_POST,'seleccionarlista');
        if (empty($nametask)==false || empty($descriptiontask)==false){
            $sql="INSERT INTO tareas(nametask,descriptiontask,taskcreatelist,usercreatetask) VALUES(?,?,?,?)";
            $bbdd=Registry::get('database');
            $stmt = $bbdd->query($sql);
            $stmt->execute([$nametask,$descriptiontask,$idtasklist,$usercreatelist]);
    
            $this->redirectTo('task');
        } else {

            ?>
            <script>
            window.alert("Faltan campos por completas.");
            location.href='/task';
            </script>
        <?php

        }
        

    }

    public function deleteTask(){
       
      
        $idtask= filter_input(INPUT_POST,'idTask');
        $sql="DELETE FROM tareas WHERE id=?;";
        $bbdd=Registry::get('database');
        $stmt = $bbdd->query($sql);
        $stmt->execute([$idtask]);

        $this->redirectTo('task');
    }

}