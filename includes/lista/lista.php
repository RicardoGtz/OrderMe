<?php
session_start();
require ('../../connectmysql.php');

// Valores para iniciar conexion:
$usuario = @$_SESSION['user'];
// Valores para la consulta y tabla
//Lista 1
$columna     = $_REQUEST['columna']; 
$sub_columna = $_REQUEST['sub_columna'];
//Lista 2
$variable = $_REQUEST['variable'];
$sub_variable = $_REQUEST['sub_variable'];
$etiqueta = $_REQUEST['etiqueta'];

?>
<!-- Checar si ocupa sub lista o no -->
<?php 
switch ($sub_columna) {
    case 'ciudad':
        ?>
        <select class = "custom-select" id="<?php echo $variable ?>" onchange = "sub_lista(this.value,
        '<?php echo $sub_columna ?>',
        '<?php echo $sub_variable ?>',
        '<?php echo $etiqueta ?>','')">
        <?php 
        break;
    default:
        ?>
        <select class = "custom-select" id="<?php echo $variable ?>">
        <?php    
        break;
}
?>

<?php
switch ($columna) {
    case 'estado':
        ?>
        <option value=''>Selecciona un Estado</option>
        <?php
        $sql = "call VerEstado();";
        break;

    default:
        ?>
        <option value=''>Seleccion</option>
        <?php
        break;
}
$result = mysqli_query($dbcon, $sql);
while ($valores = mysqli_fetch_row($result)) {
    echo "<option value='$valores[0]'>$valores[0]</option>";  
}

?>
</select>

<script >
    function sub_lista(id,sc,sv,se,x) {
        alertify.error(id);
        $(se).load("includes/lista/sub_lista.php",
            {sub_valor:id,
             sub_columna:sc,
             sub_variable:sv,
             sub_etiqueta:se,
             extra:x
         });
    }
</script>