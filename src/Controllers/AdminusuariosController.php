<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;

    if(!isset($_SESSION)){session_start();} 

class AdminusuariosController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {
        return view('adminusuarios');
    }

    public function crearUsuario(){
            $name= filter_input(INPUT_POST,'name');
            $username= filter_input(INPUT_POST,'username');
            $email= filter_input(INPUT_POST,'email');
            $password= filter_input(INPUT_POST,'password');
            $password2= filter_input(INPUT_POST,'password2');
            $role= filter_input(INPUT_POST,'role');
        
            //si las dos password son iguales
            //encriptar contraseña
            if($password==$password2){
                

                //si hay algún campo vacío que nos redirija a register
                if (empty($name) || empty($username) || empty($email) || empty($password) || empty($password2) || empty($role)){
                    echo "<body class='cuerpo-body'><div class='reg_action-existe'>Te faltan campos por completar.</div> <a class='reg_action-a' href='/adminusuarios'>Volver administración de usuarios.</a></body>"; 
                } else {

                    $hash = password_hash($password,PASSWORD_BCRYPT);
                    $sql="INSERT INTO usuarios(name, username, email, password, rol) VALUES(?,?,?,?,?)";
                    
                    $bbdd=Registry::get('database');
                    $stmt = $bbdd->query($sql);
                    $stmt->execute([$name,$username,$email,$hash,$role]);
                    
                    
                    if($role=='Alumno'){
                        $sql="INSERT INTO estudiantes(id_estudiante,codigo_curso) VALUES(?,?)";
                        $bbdd=Registry::get('database');
                        $stmt = $bbdd->query($sql);
                        $stmt->execute([$username,null]);
                    }

                    if($role=='Profesor'){
                        $sql="INSERT INTO profesores(id_profesor,id_usuario) VALUES(?,?)";
                        $bbdd=Registry::get('database');
                        $stmt = $bbdd->query($sql);

                        $stmt->execute([$username,$username]);
                    }
                    echo "<body class='cuerpo-body'><div class='reg_action-existe'>Usuario añadido correctamente.</div> <a class='reg_action-a' href='/adminusuarios'>Volver a la administración de usuarios.</a></body>"; 

                   
                }
               
            } else {
                echo "<body class='cuerpo-body'><div class='reg_action-existe'>Las contraseñas no coinciden.</div> <a class='reg_action-a' href='/adminusuarios'>Volver a la administración de usuarios.</a></body>"; 
                
            }    
    }

    public function eliminarUsuario(){

        $nombre_usuarioEliminar= filter_input(INPUT_POST,'nombre_usuarioEliminar');   

        if (empty($nombre_usuarioEliminar)==false){
            $bbdd=Registry::get('database');
            $sql="DELETE FROM tareas WHERE usercreatetask='$nombre_usuarioEliminar';";
            $sql.="DELETE FROM listas WHERE usercreatelist='$nombre_usuarioEliminar';"; 
            $sql.="DELETE FROM estudiantes WHERE id_estudiante='$nombre_usuarioEliminar';";
            $sql.="DELETE FROM profesores WHERE id_profesor='$nombre_usuarioEliminar';";
            $sql.="DELETE FROM usuarios WHERE username='$nombre_usuarioEliminar';";
            $stmt = $bbdd->query($sql);
            $stmt->execute();

            echo "<body class='cuerpo-body'><div class='reg_action-existe'>Usuario eliminado correctamente.</div> <a class='reg_action-a' href='/adminusuarios'>Volver a usuarios</a></body>"; 

        } else {
            echo "<body class='cuerpo-body'><div class='reg_action-existe'>Falta rellenar el campo.</div> <a class='reg_action-a' href='/adminusuarios'>Volver a usuarios</a></body>"; 

        }
    }

    public function asignarCurso(){
     
        $id_estudiante= filter_input(INPUT_POST,'id_estudiante');
        $codigo_curso= filter_input(INPUT_POST,'codigo_curso');

        $bbdd=Registry::get('database');

        $sql ="UPDATE estudiantes SET codigo_curso=$codigo_curso WHERE id_estudiante='$id_estudiante'";
       
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $this->redirectTo('adminusuarios');

    }

    public function asignarMateria(){
     
        $id_profesor= filter_input(INPUT_POST,'id_profesor');
        $codigo_asignatura= filter_input(INPUT_POST,'codigo_asignatura');

        $bbdd=Registry::get('database');
        $sql ="UPDATE asignaturas  SET id_profesor=? WHERE codigo_asignatura=?";
        $stmt = $bbdd->query($sql);
        $stmt->execute([$id_profesor,$codigo_asignatura]);
        $this->redirectTo('adminusuarios');

    }

}