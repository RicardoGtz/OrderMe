<?php
session_start();
$usuario = @$_SESSION['user'];

switch ($usuario) {
    case 'administradorG':
        include("botones_cliente.php");
    break;
    case 'administradorR':
        include("botones_cliente.php");
    break;
    case 'empleado':
        include("botones_cliente.php");
    break;
    case 'cliente':
        include("botones_cliente.php");
    break;
    default:
        include('botones_invitado.php');
    break;
}