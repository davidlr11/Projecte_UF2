<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SCHOOL</title>
    <link rel="stylesheet" href="<?php root();?>/public/css/style.css"/>

</head>
<body>

<br><br>
  <div class="recuadro2">


    <label class="labellogo">REGISTRARSE</label><br><br>

    <div class="formulario">
    <form action="<?= root();?>register/reg" method="POST"> 
        <input type="text" name="name" placeholder="nombre..." required/> <br><br>
        <input type="text" name="username" placeholder="usuario..." required/> <br><br>
        <input type="email" name="email" placeholder="correo electrónico..." required/> <br><br>
        <input type="password" name="password" placeholder="contraseña..." required/> <br><br>
        <input type="password" name="password2" placeholder="confirmar contraseña..." required/> <br><br>
        <div class="select">
        <select class="input_login" name="role" required>
            <option selected disabled>Seleccionar rol</option>
            <option value="Profesor">Profesor</option>
            <option value="Alumno">Alumno</option>
        </select>
            <div class="select_arrow">
            </div><br><br>
        </div>
        
        
        <button type="submit" class="myButton2">Registrarse</button><br>
        <div class="yaregistrado">¿Ya te has registrado? <a class="botonFinal" href="<?= root();?>/">Volver al login</a></div>


    </form>
    </div>
  

  </div>


</body>
</html>

