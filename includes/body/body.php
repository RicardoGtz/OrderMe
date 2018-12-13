<?php
session_start();
$usuario = @$_SESSION['user'];

switch ($usuario) {
    case 'administradorG':
        include("body_global.php");
    break;
    case 'administradorR':
        include("body_local.php");
    break;
    case 'empleado':
        include("body_empleado.php");
    break;
    case 'cliente':
        include("body_cliente.php");
    break;
    default:
        include('body_invitado.php');
    break;
}
?>