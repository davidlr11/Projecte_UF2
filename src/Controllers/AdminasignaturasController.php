<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;

class AdminasignaturasController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {
        return view('adminasignaturas');
    }

    public function crearAsignatura(){

        $asignatura= filter_input(INPUT_POST,'n_asignatura');
        $nombre_curso = filter_input(INPUT_POST,'n_curso');
        $id_profesor = filter_input(INPUT_POST,'n_profesor');

        if (empty($asignatura)==false){

            $bbdd=Registry::get('database');
            $sql="INSERT INTO asignaturas(nombre_asignatura,codigo_curso,id_profesor) VALUES(?,?,?)";
            $stmt = $bbdd->query($sql);
            $stmt->execute([$asignatura, $nombre_curso,$id_profesor]);
            echo "<body class='cuerpo-body'><div class='reg_action-existe'>Asignatura creada correctamente.</div> <a class='reg_action-a' href='/adminasignaturas'>Volver a Asignaturas</a></body>"; 

        } else {
            echo "<body class='cuerpo-body'><div class='reg_action-existe'>Falta rellenar el campo.</div> <a class='reg_action-a' href='/adminasignaturas'>Volver a Asignaturas</a></body>"; 

        }
    }

    public function modificarAsignatura(){

        $nombre_asignatura= filter_input(INPUT_POST,'nombre_asignatura');
        $num_asignaturaModificar= filter_input(INPUT_POST,'num_asignaturaModificar');
        $idCurso= filter_input(INPUT_POST,'n_curso');


        if ($nombre_asignatura!=null && empty($nombre_asignatura)==false && empty($num_asignaturaModificar)==false ){

            $bbdd=Registry::get('database');
            $sql="UPDATE asignaturas SET nombre_asignatura='$nombre_asignatura',codigo_curso='$idCurso'  WHERE codigo_asignatura=$num_asignaturaModificar";
            $stmt = $bbdd->query($sql);
            $stmt->execute();
            echo "<body class='cuerpo-body'><div class='reg_action-existe'>Asignatura actualizada correctamente.</div> <a class='reg_action-a' href='/adminasignaturas'>Volver a Asignaturas</a></body>"; 

        } else {
            echo "<body class='cuerpo-body'><div class='reg_action-existe'>Falta rellenar el campo.</div> <a class='reg_action-a' href='/adminasignaturas'>Volver a Asignaturas</a></body>"; 

        }
    }

    public function eliminarAsignatura(){

        $nombre_asignaturaEliminar= filter_input(INPUT_POST,'nombre_asignaturaEliminar');   

        if (empty($nombre_asignaturaEliminar)==false){
            $bbdd=Registry::get('database');
            $sql="DELETE FROM asignaturas WHERE codigo_asignatura=$nombre_asignaturaEliminar;";  
            $stmt = $bbdd->query($sql);
            $stmt->execute();

            echo "<body class='cuerpo-body'><div class='reg_action-existe'>Asignatura eliminada correctamente.</div> <a class='reg_action-a' href='/adminasignaturas'>Volver a Asignaturas</a></body>"; 

        } else {
            echo "<body class='cuerpo-body'><div class='reg_action-existe'>Falta rellenar el campo.</div> <a class='reg_action-a' href='/adminasignaturas'>Volver a Asignaturas</a></body>"; 

        }
    }
}