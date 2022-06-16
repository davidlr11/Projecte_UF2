<?php require('partials/headSessionAdmin.php'); ?>
<?php 
use App\Registry;
if(!isset($_SESSION)){session_start();} 
?>

<style>
  table{
    display: flex;
    justify-content: center;
    margin:10px 400px 0px 400px;
  }
  td{
    padding: 10px;
  }
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
<br>


<br>
<h2 class="recuador21">CREAR USUARIOS</h2>
<div class="recuadro2">

<form action="<?= root();?>adminusuarios/crearUsuario" method="POST"> 
  Nombre: <input type="text" name="name" required/> <br><br>
  Usuario: <input type="text" name="username" required/> <br><br>
  Correo: <input type="email" name="email" required/> <br><br>
  Contraseña: <input type="password" name="password" required/> <br><br>
  Repite la contraseña: <input type="password" name="password2" required/> <br><br>
  <select class="input_login" name="role" required>
     <option selected disabled>Seleccionar rol</option>
      <option value="Profesor">Profesor</option>
      <option value="Alumno">Alumno</option>
  </select><br><br>
  <input type="submit" value="Registrar usuario"/>  <br>

</form>
</div>
<h2 class="recuador21">ELIMINAR USUARIO</h2><br>
<div class="recuadro2">
<form action="<?= root();?>adminusuarios/eliminarUsuario" method="POST"> 
Usuario: <select name="nombre_usuarioEliminar"  required>
    <option selected disabled>Seleccionar usuario</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT * FROM usuarios EXCEPT SELECT * FROM usuarios WHERE username='admin' ORDER BY rol;";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
            echo "<option name='nombre_usuarioEliminar' value=".$valores['username'].">".$valores['name']."</option>";
          
        } 
    ?>
  </select><br><br> 
  <input type="submit" value="Eliminar usuario"/>  <br>
</form>
</div>


<h2 class="recuador21">Usuarios:</h2>
<table class="tabla" border=1>
 <tr>
   <th>Nombre</th>
   <th>Email</th>
   <th>Usuario</th>
   <th>Rol</th>
 </tr>
 
<?php
 $bbdd=Registry::get('database');
                    
 
 $sql ="SELECT * from usuarios;";
 $stmt = $bbdd->query($sql);
 $stmt->execute();
 $request = $stmt->fetchAll();

  
 foreach($request as $valores){
     $email=$valores['email'];
     $username=$valores['username'];
     $name=$valores['name'];
     $rol=$valores['rol'];
     ?>
     
         
            <tr>
              <td><?php echo $name ?></td>
              <td><?php echo $email ?></td>
              <td><?php echo $username ?></td>
              <td><?php echo $rol ?></td>

            </tr>
<?php          
}   
?>

 </table>
<br><br>


<h2 class="recuador21">ASIGNAR ALUMNOS A CURSOS</h2>
<div class="recuadro2">
<form action="<?= root();?>adminusuarios/asignarCurso" method="POST"> 
Curso: <select name="codigo_curso"  required>
    <option selected disabled>Seleccionar curso</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT * FROM cursos ORDER BY codigo_curso;";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
            echo "<option name='codigo_curso' value=".$valores['codigo_curso'].">".$valores['nombre_curso']."</option>";
          
        } 
    ?>
  </select><br><br>
  Alumno: <select name="id_estudiante"  required>
    <option selected disabled>Seleccionar alumno</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT * FROM estudiantes";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          
            echo "<option name='id_estudiante' value=".$valores['id_estudiante'].">".$valores['id_estudiante']."</option>";
          
        } 
    ?>
  </select><br><br>
  <input type="submit" value="Asignar"/>  <br>

</form>
      </div>

<h2 class="recuador21">ASIGNAR PROFESORES A MATERIAS</h2>
<div class="recuadro2">
<form action="<?= root();?>adminusuarios/asignarMateria" method="POST"> 
Asignatura: <select name="codigo_asignatura"  required>
    <option selected disabled>Seleccionar asignatura</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT codigo_asignatura,nombre_asignatura, asignaturas.codigo_curso, cursos.codigo_curso, nombre_curso FROM asignaturas INNER JOIN cursos ON asignaturas.codigo_curso=cursos.codigo_curso;";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
            echo "<option name='codigo_asignatura' value=".$valores['codigo_asignatura'].">".$valores['nombre_asignatura']." (".$valores["nombre_curso"].")</option>";
          
        } 
    ?>
  </select><br><br>
  Profesor: <select name="id_profesor"  required>
    <option selected disabled>Seleccionar profesor</option>
    <?php
        
        $bbdd=Registry::get('database');
        $sql ="SELECT * FROM profesores;";
        $stmt = $bbdd->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          var_dump($request);
            echo "<option name='id_profesor' value=".$valores['id_profesor'].">".$valores['id_profesor']."</option>";
          
        } 
    ?>
  </select><br><br>
  <input type="submit" value="Asignar"/>  <br>

</form>
</div> 
<?php require('partials/footer.php');?>
