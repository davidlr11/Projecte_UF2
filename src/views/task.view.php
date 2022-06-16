<?php require('partials/headSession.php'); ?>
<?php use App\Registry;?>

<?php
    if(!isset($_SESSION)){session_start();} 
?>
<style>
  body {
        background-color: #add3ff;
    }
  .general{
    margin: 10px;
  }
  .cajas_home1{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
  }
  .cajasTareas{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: auto;
    border-radius: 3px;
    background-color:#57ccff;
    margin:15px;
    padding: 15px;
  }
  .botones{
    background-color: #337cd6; 
    border: none;
    color: white;
    padding: 10px 30px;
    margin:0px 10px 0px 10px; 
    border-radius: 3px;
    text-align: center;
    text-decoration: none;
    font-size: 12px;
  }
  .botones1{
    background-color: #d63333; 
    border: none;
    color: white;
    padding: 10px 30px;
    margin:0px 10px 0px 10px; 
    border-radius: 3px;
    text-align: center;
    text-decoration: none;
    font-size: 12px;
  }
  .cajabotones{
    display: flex;
    flex-direction: row;
  }
  .formulario{
    display: flex;
    margin: 20px 500px 0px 500px;
    align-items: center;
    justify-content: center;
    background-color: white;
    border-radius: 3px;
    padding: 20px;
  }
  .select {

    position: relative;
    display: inline-block;

    width: 100%;
}    .select select {
        font-family: 'Arial';
        display: inline-block;
        width: 100%;
        cursor: pointer;
        padding: 10px 20px;
        outline: 0;
        border: 1px hidden #2f2f2f;
        border-radius: 3px;
        background: #282828;
        color: #e5e5e5;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
        .select select::-ms-expand {
            display: none;
        }
        .select select:hover,
        .select select:focus {
            color: #ffffff;
            background: #282828;
        }
        .select select:disabled {
            opacity: 0.1;
            pointer-events: none;
        }
.select_arrow {
    position: absolute;
    top: 11px;
    right: 21px;
    width: 0px;
    height: 0px;
    border: solid #ffffff;
    border-width: 0 3px 3px 0;
    display: inline-block;
    padding: 3px;
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
}
.select select:hover ~ .select_arrow,
.select select:focus ~ .select_arrow {
    border-color: #ffffff;
}
.select select:disabled ~ .select_arrow {
    border-top-color: #d43e3e;
}
.myButton2 {
    margin: 0px 0px 0px 75px;
	background-color:#34a5fc;
	border-radius:3px;
	border:2px solid #0071c7;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:13px;
	font-weight:bold;
	padding:10px 20px;
	text-decoration:none;
}
.myButton2:hover {
	background-color:#63bbff;
}
.myButton2:active {
	position:relative;
	top:1px;
}

input {
    width:85%;
  padding: 12px 20px;
  border: 1px solid black;
  border-radius: 3px;

}


</style>
<div class="general">
  <div class="formulario">
<form action="<?= root();?>task/createTask" method="POST"> 
  <input type="text" name="name_task" placeholder="Nombre de la tarea..." required/> <br><br>
  <input type="text" placeholder="Descripcion..." name="description_task" /> <br><br>
  
  <div class="select">
  <select name="seleccionarlista"  >
    <option selected disabled>Seleccionar lista</option>
    <?php
        //Vamos a preparar la sentencia para que salgan en el seleccionador las listas creadas.
        $bbdd=Registry::get('database');
        $sql ="SELECT * FROM listas WHERE usercreatelist=?;";
        $stmt = $bbdd->query($sql);
        $stmt->execute([$_SESSION["username"]]);
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          
            echo "<option name='seleccionarlista' value=".$valores['id'].">".$valores['namelist']."</option>";
          
        } 
    ?>
  </select>
      <div class="select_arrow">
      </div><br><br>
  </div>
  <button class="myButton2" type="submit">Añadir tarea</button><br>

</form>
</div>
<br><br>
<!-- <div class="tareascreadas"><b>Tareas creadas por:</b> <?php /*echo $_SESSION["username"]; echo "<br>";*/?></div> -->
                <?php 
                    $bbdd=Registry::get('database');
                    
                    // (*0*) Sacar por pantalla las tareas creadas - SESSION, que indica que usuario ha creado la tarea para solo mostrar aquellas tareas que ha agregado el usuario en cuestión
                    
                    $sql ="SELECT * from tareas WHERE usercreatetask = ?;";
                    $stmt = $bbdd->query($sql);
                    $username = $_SESSION["username"];
                    $stmt->execute([$username ]);
                    $request = $stmt->fetchAll();
                    
                    // (*1*)Sacar por pantalla a que lista pertenece cada tarea
                    $sql ="SELECT * from listas WHERE usercreatelist = ?;";
                    $stmt = $bbdd->query($sql);
                    $username = $_SESSION["username"];
                    $stmt->execute([$username ]);
                    $request0 = $stmt->fetchAll();

                    //FOREACH DE QUE TAREAS A CREADO X USUARIO (*0*)
                    foreach($request as $valores){
                        $taskname=$valores['nametask'];
                        $taskdescription=$valores['descriptiontask'];
                        $list_task=$valores['taskcreatelist'];
                        $id_task=$valores['id'];
                  
                        foreach($request0 as $valores0){
                            if ($valores0['id']==$list_task){
                                $list_name_task=$valores0['namelist'];
                            }
                        }
                        if (empty($taskname)==false && empty($taskdescription)==false){
                            echo "<div class='cajas_home1'><div class='cajasTareas'><p><b>Lista:</b> ".$list_name_task."<br>
                            <b>Tarea:</b> ".$taskname." <br>
                            <b>Descripcion: </b>".$taskdescription."</p>";
                        } else if (empty($taskname)==false && empty($taskdescription)==true) {
                            echo "<div class='cajas_home1'><div class='cajasTareas'><p><b>Lista:</b> ".$list_name_task."<br>
                            <b>Tarea:</b> ".$taskname."</p><br>";
                        } 
                        
                        ?>
                        <div class='cajabotones'>
                        
                            <form action="<?php root(); ?>login/log" method='POST'>
                                <button type='submit' class='botones'>EDITAR</button><br>
                            </form>
                          <br><br>
                            <form action="<?php root(); ?>task/deleteTask" method='POST'>
                                <input name='idTask' value='<?php echo $id_task ?>' hidden>
                                <button type='submit' class='botones1'>ELIMINAR</button><br>
                            </form>
                            <?php echo "</div> </div>"?>
                    <?php    
                      }
                    ?>

      </div>
  </div>


<?php require('partials/footer.php'); ?>
