<?php require('partials/headSession.php'); use App\Registry; ?>
<?php
    if(!isset($_SESSION)){session_start();} 
?>
<style>
    .general{
        margin: 0px 50px 0px 50px;
    }
    body {
        background-color: #add3ff;
    }
    .caja2_home{
        display: flex;
        flex-direction: row;
    }
    .perfil{
        width: 33%;
        height: auto;
        background-color: #688ead;
        padding: 30px;
        margin:30px;
        border-radius: 3px;
        display: flex;
        justify-content: center;
        align-items: center;
        
    }
</style>

<div class="general">
    <h1>Perfil</h1>
        <div class="cajas_home1">
        <p>Bienvenido, <?php echo $_SESSION["name_login"]; echo "<br>";?></p> 
        <hr style="border: 1px solid black; border-radius: 3px;">
            <div class="caja2_home">
                <div class="perfil">Usuario: <?php echo $_SESSION["username"];?></div> 
                <div class="perfil">Email: <?php echo $_SESSION["email_login"];?></div> 
                <div class="perfil">Rol de usuario: <?php echo $_SESSION["role_login"];?></div> 
            </div>
        </div><br>
</div>
<?php require('partials/footer.php'); ?>
