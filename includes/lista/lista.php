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
        //Lista 3
        $sub_columna2=$_REQUEST['sub_columna2'];
        $sub_variable2 = $_REQUEST['sub_variable2'];
        $etiqueta2 = $_REQUEST['etiqueta2'];

        $sub_columna3=$_REQUEST['sub_columna3'];
        $sub_variable3 = $_REQUEST['sub_variable3'];
        $etiqueta3 = $_REQUEST['etiqueta3'];

        ?>
        <select class = "custom-select" id="<?php echo $variable ?>" onchange = "ciudad(this.value,
            '<?php echo $sub_columna ?>',
            '<?php echo $sub_variable ?>',
            '<?php echo $etiqueta ?>',

            '<?php echo $sub_columna2 ?>',
            '<?php echo $sub_variable2 ?>',
            '<?php echo $etiqueta2 ?>',

            '<?php echo $sub_columna3 ?>',
            '<?php echo $sub_variable3 ?>',
            '<?php echo $etiqueta3 ?>',
            ''
        )">
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
    function ciudad(id,sc,sv,se,sc2,sv2,se2,sc3,sv3,se3,x) {
        alertify.error(id);
        $(se).load("includes/lista/sub_lista.php",
            {
             sub_valor:id,
             sub_columna:sc,
             sub_variable:sv,
             sub_etiqueta:se,

             sub_columna2:sc2,
             sub_variable2:sv2,
             etiqueta2:se2,

             sub_columna3:sc3,
             sub_variable3:sv3,
             etiqueta3:se3,

             extra:x
         });
    }

    function sub_lista_2(id,sc,sv,se,sc2,sv2,se2,x) {
        $(se).load("componentes/sub_lista.php",
            {sub_valor:id,
             sub_columna:sc,
             sub_variable:sv,
             sub_etiqueta:se,
             sub_columna2:sc2,
             sub_variable2:sv2,
             sub_etiqueta2:se2,
             extra:x
         });
    }
</script>