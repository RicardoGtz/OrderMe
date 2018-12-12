<?php
session_start();
$usuario = @$_SESSION['user'];

switch ($usuario) {
    case 'administradorG':
        include("menu_global.php");
    break;
    case 'administradorR':
        include("menu_local.php");
    break;
    case 'empleado':
        include("menu_empleado.php");
    break;
    case 'cliente':
        include("menu_cliente.php");
    break;
    default:
        include('menu_invitado.php');
    break;
}
?>