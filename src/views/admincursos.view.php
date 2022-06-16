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

<h2 class="recuador21">CREAR CURSO</h2>
<div class="recuadro2">
<form action="<?= root();?>admincursos/crearCurso" method="POST"> 
  Curso: <input type="text" name="curso" required/> <br><br>
  <input type="submit" value="Añadir curso"/>  <br>
</form>
</div>

<h2 class="recuador21">ACTUALIZAR CURSO</h2>
<div class="recuadro2">
<form action="<?= root();?>admincursos/modificarCurso" method="POST"> 
Curso: <select name="num_cursoModificar"  required>
    <option selected disabled>Seleccionar curso</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT * FROM cursos ORDER BY codigo_curso;;";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
            echo "<option name='num_cursoModificar' value=".$valores['codigo_curso'].">".$valores['nombre_curso']."</option>";
          
        } 
    ?>
  </select><br><br>
  Nombre curso: <input type="text" name="nombre_curso"/> <br><br>
  <input type="submit" value="Actualizar curso"/>  <br>
</form>
</div>

<h2 class="recuador21">ELIMINAR CURSO</h2><br>
<div class="recuadro2">
<form action="<?= root();?>admincursos/eliminarCurso" method="POST"> 
Curso: <select name="nombre_cursoEliminar"  required>
    <option selected disabled>Seleccionar curso</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT * FROM cursos ORDER BY codigo_curso;";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
            echo "<option name='nombre_cursoEliminar' value=".$valores['codigo_curso'].">".$valores['nombre_curso']."</option>";
          
        } 
    ?>
  </select><br><br> 
  <input type="submit" value="Eliminar curso"/>  <br>
</form>
</div>


<h2 class="recuador21" >Cursos:</h2>
 
<?php

$bbdd=Registry::get('database');
                    
 
 $sql ="SELECT * from cursos ORDER BY codigo_curso;";
 $stmt = $bbdd->query($sql);
 $stmt->execute();
 $request = $stmt->fetchAll();


 foreach($request as $valores){
     $codigo_curso=$valores['codigo_curso'];
     $nombre_curso=$valores['nombre_curso'];
     ?>
     <div class="cajasTareas">
      <?php echo $nombre_curso ?>
     </div>
  <?php
} 
     
  ?>
  
 </table>
<br><br>

<?php require('partials/footer.php'); ?>
