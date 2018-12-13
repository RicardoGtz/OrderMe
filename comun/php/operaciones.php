<?php
session_start();
//require_once "../comun/php/conexion.php";
require ('connectmysql.php');

$tabla = $_POST['tabla'];
$operacion = $_POST['operacion'];

switch ($tabla) {
    // USUARIO
    case 'Usuarios':
        if($operacion!='eliminar' && $operacion!='iniciar')
        {
            $var1 = $_POST['var1'];
            $var2 = $_POST['var2'];
            $var3 = $_POST['var3'];
            $var4 = $_POST['var4'];
            $var5 = $_POST['var5'];
            $var6 = $_POST['var6'];
            $var7 = $_POST['var7'];
            $var8 = $_POST['var8'];
            $var9 = $_POST['var9'];
            $var10 = $_POST['var10'];
        }
        else{
            $var1 = $_POST['var1'];
            $var2 = $_POST['var2'];
        }

        switch ($operacion) {
            case 'agregar':
                $sql  = "select InsertarUsuario('$var1','$var2','$var3','$var4','$var5','$var6','$var7','$var8','$var9','$var10') as resp";
                break;
            case 'actualizar':
                $sql = "select ActualizarUsuario('$var1','$var1','$var2','$var3','$var4','$var5','$var6','$var7','$var8','$var9','$var10') as resp";
                break;
            case 'eliminar':
                //$sql = "call e_eliminar_vt('$var1','$var2','$valor');";
                break;
        }
        break;
}

$res=@mysqli_query($dbcon,$sql);
$row=mysqli_fetch_assoc($res);
mysqli_close($dbcon);
echo $row['resp'];

//echo $result = mysqli_query($dbcon, $sql);