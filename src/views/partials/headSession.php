<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SCHOOL</title>
</head>
<style>
body{
    margin:0;
    padding: 0;
}
a{
    text-decoration: none;
    color: black;
}
nav{
    margin:0px;
    padding:20px;
    width: 100%;
    height: auto;
    display: flex;
    background-color: #34a5fc;
    justify-content: space-around;
    align-items: center;

}
.letrasNav0{
    color:black;
    font-weight: 600;
    font-size: 20px;
}
.letrasNav{
    color:black;
    font-weight: 600;
    font-size: 14px;
}
</style>
<body>
<?php error_reporting(0);?>
<nav>
        <a class="letrasNav0" href="<?= root();?>dashboard">SCHOOL</a>
        <a class="letrasNav" href="<?= root();?>list">Listas</a>
        <a class="letrasNav" href="<?= root();?>task">Tareas</a>
        <a class="letrasNav" href="<?= root();?>visualizarasignaturas">Mis asignaturas</a>
        <a class="letrasNav" href="<?= root();?>/">Cerrar sesión</a>
</nav>