<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;


class RegisterController extends Controller {

    public function __construct(Request $request,Session $session){
        
        parent::__construct($request,$session);

    } 
        public function index(){
            return view('register');
        }

        public function reg(){
            try{
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
                        ?>
                        <script>
                        window.alert("Te faltan campos por completar.");
                        location.href='/register';
                        </script>
                    <?php                    
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
                        $this->redirectTo('');
                       
                    }
                   
                } else {
                ?>
                    <script>
                    window.alert("Las contraseñas no coinciden.");
                    location.href='/register';
                    </script>
                <?php  
                }
           }catch(\Exception $e){
               die($e->getMessage());
           }       
        }
}
