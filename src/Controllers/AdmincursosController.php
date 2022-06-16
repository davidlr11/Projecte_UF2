<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;

class AdmincursosController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {
        return view('admincursos');
    }

    public function crearCurso(){

        $curso= filter_input(INPUT_POST,'curso');

        if (empty($curso)==false){

            $bbdd=Registry::get('database');
            $sql="INSERT INTO cursos(nombre_curso) VALUES(?)";
            $stmt = $bbdd->query($sql);
            $stmt->execute([$curso]);
            ?>
            <script>
            window.alert("Curso creado correctamente.");
            location.href='/admincursos';
            </script>
            <?php

        } else {
            ?>
            <script>
            window.alert("Falta rellenar el campo.");
            location.href='/admincursos';
            </script>
            <?php
        }
    }

    public function modificarCurso(){

        $nombre_curso= filter_input(INPUT_POST,'nombre_curso');
        $num_cursoModificar= filter_input(INPUT_POST,'num_cursoModificar');
        

        if ($nombre_curso!=null && empty($nombre_curso)==false && empty($num_cursoModificar)==false ){

            $bbdd=Registry::get('database');
            $sql="UPDATE cursos SET nombre_curso='$nombre_curso' WHERE codigo_curso=$num_cursoModificar";
            $stmt = $bbdd->query($sql);
            $stmt->execute();
            ?>
            <script>
            window.alert("Curso actualizado correctamente.");
            location.href='/admincursos';
            </script>
            <?php
        } else {
            ?>
            <script>
            window.alert("Falta rellenar el campo.");
            location.href='/admincursos';
            </script>
            <?php
        }
    }

    public function eliminarCurso(){

        $nombre_cursoEliminar= filter_input(INPUT_POST,'nombre_cursoEliminar');   

        if (empty($nombre_cursoEliminar)==false){
            $bbdd=Registry::get('database');
            $sql="UPDATE estudiantes SET codigo_curso=NULL WHERE codigo_curso=$nombre_cursoEliminar;";
            $sql.="DELETE FROM asignaturas WHERE codigo_curso=$nombre_cursoEliminar;";
            $sql.="DELETE FROM cursos WHERE codigo_curso=$nombre_cursoEliminar;";  
            $stmt = $bbdd->query($sql);
            $stmt->execute();
            //$ncursoDelete=$stmt->fetchAll();
            //var_dump(implode($ncursoDelete));

           /* $bbdd=Registry::get('database');
            $sql="
            DELETE FROM estudiantes WHERE 
            UPDATE cursos SET nombre_curso='$nombre_curso' WHERE codigo_curso=$num_cursoModificar";
            
            $stmt = $bbdd->query($sql);
            $stmt->execute();*/
            ?>
            <script>
            window.alert("Curso y sus asignaturas asignadas, eliminadas correctamente.");
            location.href='/admincursos';
            </script>
            <?php

        } else {
            ?>
            <script>
            window.alert("Curso y sus asignaturas asignadas, eliminadas correctamente.");
            location.href='/admincursos';
            </script>
            <?php
        }
    }


}