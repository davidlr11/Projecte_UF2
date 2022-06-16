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

  .formulario{
    display: flex;
    margin: 20px 500px 0px 500px;
    align-items: center;
    justify-content: center;
    background-color: white;
    border-radius: 3px;
    padding: 20px;
  }

.myButton2 {
    margin: 0px 0px 0px 50px;
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
  <form action="<?= root();?>list/createList" method="POST"> 
  <input type="text" placeholder="Nombre de la lista..." name="name_list" /> <br><br>
  <button type="submit" class="myButton2">Crear lista</button> <br>

</form>
</div>

<?php 
                    $bbdd=Registry::get('database');
                    $username=$_SESSION['username'];
                    $sql ="SELECT * from listas WHERE usercreatelist = '$username';";
                    $stmt = $bbdd->query($sql);
                    $stmt->execute();
                    $request = $stmt->fetchAll();

                    foreach($request as $valores){
                        $listname=$valores['namelist'];
                  
                        ?>
                        <br>
                        <div class='cajas_home1'>
                          <div class='cajasTareas'>
                            <p><b>Lista: </b><?php echo $listname ?></p>
                         </div>
                        <?php
                        ?>
                    <?php    
                      }
                    ?>
<?php require('partials/footer.php'); ?>



