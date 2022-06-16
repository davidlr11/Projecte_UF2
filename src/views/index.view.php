<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SCHOOL</title>
    <link rel="stylesheet" href="<?php root();?>/public/css/style.css"/>

</head>
<body>

<br><br>
  <div class="recuadro">

    <div class="logo">
      <label class="labellogo">SCHOOL</label><br><br>
      <img src="<?php root();?>/public/img/logo.png" width="50%" height="auto">
    </div>
    <div class="formulario">
    <form action="<?= root();?>login/log" method="POST"> 
      <label>INICIAR SESIÓN</label><br><br>
      <input type="text" name="username" class="inputlogin" placeholder="usuario..." required/> <br><br>
      <input type="password" name="password" placeholder="contraseña..." required/> <br><br>
      <!-- Recordar contraseña<input type="checkbox" name="remember1"/> <br> -->
      
      <button type="submit" class="myButton">Iniciar Sesión</button><br>
      ¿No estás registrado todavía? <a class="botonFinal" href="<?= root();?>register"> Registrarse</a></li>
    </form>
    </div>
  

  </div>


</body>
</html>
