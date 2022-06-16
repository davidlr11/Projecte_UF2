<?php require('partials/headSession.php'); use App\Registry; ?>
<?php
    if(!isset($_SESSION)){session_start();} 
?>
<style>

table, th, td {
  border: 2px solid;
  padding: 4px;
}
body {
        background-color: #add3ff;
    }
  .general{
    margin: 10px;

  }
  .misasignaturas{
      margin: 0px 0px 40px 400px;
  }
  .cajas_home1{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
  }
  .cajas_home11{
    display: flex;
    flex-wrap: column;
    justify-content: center;
    align-items: center;
  }
  .cajasTareas{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    width: auto;
    border-radius: 3px;
    background-color:#57ccff;
    margin:0px 15px;
    padding: 30px;
  }
  .cajasTareas1{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
 
    width: auto;
    border-radius: 3px;
    background-color:#57ccff;
    margin:20px 400px 20px 400px;
    padding: 30px;
  }
</style>
<br><br>

<?php if($_SESSION['role_login']=='Alumno'){ ?>

    <div class="general">
    <h2 class="misasignaturas"><b>MIS ASIGNATURAS</b></h2>
    <div class='cajas_home1'>
            <?php
            
            $nombreUsuario = $_SESSION['username'];
           
            $bbdd=Registry::get('database');    
            $sql="SELECT nombre_asignatura,id_profesor,cursos.nombre_curso FROM asignaturas  INNER JOIN estudiantes ON asignaturas.codigo_curso=estudiantes.codigo_curso INNER JOIN cursos ON cursos.codigo_curso=asignaturas.codigo_curso WHERE id_estudiante='$nombreUsuario'";
            $stmt = $bbdd->query($sql);
            $stmt->execute();
            $request = $stmt->fetchAll();
            
            foreach($request as $valores){
                $nombreAsignatura=$valores['nombre_asignatura'];
                $nombre_curso=$valores['nombre_curso'];
                $idProfesor=$valores['id_profesor'];
                
                ?>
                
                    <div class='cajasTareas'>
                        <?php echo "Asignatura: ".$nombreAsignatura ?><br>
                        <?php echo "Profesor: ".$idProfesor ?><br>

                        <?php echo "Curso: ".$nombre_curso ?>
                    </div>
                
            <?php          
            }   
            ?>
            </div>
        </div>
<br>
</div>

<?php } if($_SESSION['role_login']=='Profesor'){?>
<div class="general">
   
        <!-- <table class="tabla">
        <tr>
        <th>Nombre asignatura</th>
        <th>Curso</th>
        </tr> -->

        <?php
        
        $nombreUsuario = $_SESSION['username'];
       
        $bbdd=Registry::get('database');  
        $sql="SELECT * FROM asignaturas WHERE id_profesor='$nombreUsuario' ";  
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request0 = $stmt->fetchAll();

        $bbdd=Registry::get('database');  
        $sql="SELECT * FROM cursos";  
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();

        $bbdd=Registry::get('database');  
        $sql="SELECT * FROM estudiantes";  
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request1 = $stmt->fetchAll();


        foreach($request0 as $valores0){
            $nombreAsignatura=$valores0['nombre_asignatura'];
            $codigo_curso=$valores0['codigo_curso'];
            $idProfesor=$valores0['id_profesor'];
            

            foreach($request as $valores){

                if($valores['codigo_curso']==$codigo_curso){
                    $cursos_codigo_curso=$valores['codigo_curso'];
                    $nombre_curso=$valores['nombre_curso'];
                }
            }
            ?>
            <div class='cajasTareas1'>
            <?php
            echo "Asignatura: ".$nombreAsignatura."\n<br><br>";
            echo "Curso: ".$nombre_curso."<br><br>";
            echo "Alumnos:<br><br>";
            foreach($request1 as $valores1){

                if($valores1['codigo_curso']==$cursos_codigo_curso){
                    $nombre_alumno=$valores1['id_estudiante'];
                    echo $nombre_alumno."<br>";
                }
            }


            echo "<br></div>";           
        }   
        ?>


 
<br>
</div>

<?php }?>


<br><br>
<?php require('partials/footer.php'); ?>
