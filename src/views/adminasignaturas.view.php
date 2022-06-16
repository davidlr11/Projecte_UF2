<?php require('partials/headSessionAdmin.php'); ?>
<?php 
use App\Registry;
if(!isset($_SESSION)){session_start();} 
?>
<style>
  body {
        background-color: #add3ff;
    }
    .recuador21{
      margin: 50px 0px 0px 250px;
    }
    .recuadro2{
    display:flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px 0px 30px 0px;
    margin: 0px 250px 50px 250px;
    background-color: white;
    border-radius: 3px;
}



  .cajasTareas{
    display: flex;
    flex-direction: row; 
    justify-content: center;
    align-items: center;
    border-radius: 3px;
    background-color:#57ccff;
    margin:15px 400px 15px 400px;

    padding: 15px;
  }
</style>

<h2 class="recuador21">CREAR ASIGNATURA</h2><br>

<div class="recuadro2">
<form action="<?= root();?>adminasignaturas/crearAsignatura" method="POST"> 
  Nombre de la asignatura: <input type="text" name="n_asignatura" require/> <br><br>  
  Curso: <select name="n_curso"  require>
    <option selected disabled>Seleccionar curso</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT * FROM cursos;";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          var_dump($request);
            echo "<option name='n_curso' value=".$valores['codigo_curso'].">".$valores['nombre_curso']."</option>";
          
        } 
    ?>
  </select><br><br>
  Profesor: <select name="n_profesor"  require>
    <option selected disabled>Seleccionar profesor</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT * FROM profesores;";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
         
            echo "<option name='n_profesor' value=".$valores['id_profesor'].">".$valores['id_profesor']."</option>";
          
        } 
    ?>
  </select><br><br>
  <input type="submit" value="Añadir asignatura"/>  <br>
  </form>

</div>

<h2 class="recuador21">ACTUALIZAR ASIGNATURA</h2>
<div class="recuadro2">
<form action="<?= root();?>adminasignaturas/modificarAsignatura" method="POST"> 
Asignatura: <select name="num_asignaturaModificar"  required>
    <option selected disabled>Seleccionar asignatura</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT codigo_asignatura,nombre_asignatura, asignaturas.codigo_curso, cursos.codigo_curso, nombre_curso FROM asignaturas INNER JOIN cursos ON asignaturas.codigo_curso=cursos.codigo_curso;";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
            echo "<option name='num_asignaturaModificar' value=".$valores['codigo_asignatura'].">".$valores['nombre_asignatura']." (".$valores["nombre_curso"].")</option>";
          
        } 
    ?>
  </select><br><br> 
  Curso: <select name="n_curso"  require>
    <option selected disabled>Seleccionar curso</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT * FROM cursos;";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          var_dump($request);
            echo "<option name='n_curso' value=".$valores['codigo_curso'].">".$valores['nombre_curso']."</option>";
          
        } 
    ?>
  </select><br><br>
  Nombre asignatura: <input type="text" name="nombre_asignatura" /> <br><br>
  <input type="submit" value="Actualizar asignatura"/>  <br>
</form>

</div>

<h2 class="recuador21">ELIMINAR ASIGNATURA</h2><br>
<div class="recuadro2">
<form action="<?= root();?>adminasignaturas/eliminarAsignatura" method="POST"> 
Eliminar: <select name="nombre_asignaturaEliminar"  required>
    <option selected disabled>Seleccionar asignatura</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT codigo_asignatura,nombre_asignatura, asignaturas.codigo_curso, cursos.codigo_curso, nombre_curso FROM asignaturas INNER JOIN cursos ON asignaturas.codigo_curso=cursos.codigo_curso;";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        
        foreach($request as $valores){
            echo "<option name='nombre_asignaturaEliminar' value=".$valores['codigo_asignatura'].">".$valores['nombre_asignatura']." (".$valores["nombre_curso"].")</option>";
          
        } 
    ?>
  </select><br><br> 
  <input type="submit" value="Eliminar asignatura"/>  <br>
</form>
<br><br>
</div>

  <h2 class="recuador21"> Asignaturas:</h2>
<?php
 $bbdd=Registry::get('database');
                    
 

 $sql ="SELECT nombre_asignatura,id_profesor, asignaturas.codigo_curso, cursos.codigo_curso, nombre_curso FROM asignaturas INNER JOIN cursos ON asignaturas.codigo_curso=cursos.codigo_curso;";
 $stmt = $bbdd->query($sql);
 $stmt->execute();
 $request = $stmt->fetchAll();


 foreach($request as $valores){
     $nombre_asignatura=$valores['nombre_asignatura'];
     $codigo_curso=$valores['codigo_curso'];
     $nombre_curso=$valores['nombre_curso'];
     $id_profesor=$valores['id_profesor'];
     ?>
          <div class='cajasTareas'>
            <p><b>Asignatura:</b><?php echo $nombre_asignatura ?><br>
            <b>Curso:</b> <?php echo $nombre_curso ?><br>
            <b>Profesor: </b><?php echo $id_profesor ?></p><br>
         </div> 
         <?php
         
} 
?><br><br>

<?php require('partials/footer.php'); ?>
