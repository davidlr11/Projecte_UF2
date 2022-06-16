<?php
    
    namespace App\Controllers;
    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;
    //session_start();
    error_reporting(0);
class LoginController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 

    public function index(){

    }
    
    public function log()
    {
        //$users = Registry::get('database')->selectAll('usuarios');
        $username= filter_input(INPUT_POST,'username');
        $password= filter_input(INPUT_POST,'password');
        //si hay algún campo vacío que nos redirija a register
        
        if (empty($username) || empty($password) ){
            ?>
            <script>
            window.alert("Te faltan campos por completar.");
            location.href='/';
            </script>
            <?php         
        } else {
            
            $bbdd=Registry::get('database');
            $sql ="SELECT * FROM usuarios WHERE username=?;";
            $stmt = $bbdd->query($sql);
            $stmt->execute([$username]);
            $request = $stmt->fetchAll();
            
            foreach ($request as $name){
                $name_login=$name['name'];
                
            }
            foreach ($request as $email){
                $email_login=$email['email'];
                
            }
            //para que solo pueda ver las tareas del usuario
            foreach ($request as $valor){
                $idusertask=$valor['id'];
            }
            foreach ($request as $role) {
                $role_login=$role['rol'];
            
            }
            if ($username=='admin'){
                $phash=$request[0];
                $passwdhash=password_verify($password,$phash['password']);
                if($passwdhash){
                    $_SESSION["username"]=$username;
                    $_SESSION["name_login"]=$name_login;
                    $_SESSION["role_login"]=$role_login;
                    $_SESSION["email_login"]=$email_login;
                    $this->redirectTo('dashboardadmin');
                } else {
                    ?>
                    <script>
                    window.alert("Contraseña fallida. Comprueba que tus datos son los correctos.");
                    location.href='/';
                    </script>
                    <?php  
                }
            } else if(empty($request)==false){
                //Si la contraseña que comprobamos con password_verify
                $phash=$request[0];
                $passwdhash=password_verify($password,$phash['password']);
                if($passwdhash){
                    $_SESSION["username"]=$username;
                    $_SESSION["name_login"]=$name_login;
                    $_SESSION["role_login"]=$role_login;
                    $_SESSION["email_login"]=$email_login;
            
                    //SESSION para saber el id del usuario, para que cuando haga login, solo se muestren las tareas que ha añadido dicho
                    $_SESSION["taskiduser"]=$idusertask;


                    $this->redirectTo('dashboard');
                }else {
                    ?>
                    <script>
                    window.alert("Contraseña fallida. Comprueba que tus datos son los correctos.");
                    location.href='/';
                    </script>
                    <?php                }
            } else {
                ?>
                <script>
                window.alert("Usuario no encontrado. Comprueba que tus datos son los correctos.");
                location.href='/';
                </script>
                <?php            
            }
            
        }



    }

    }