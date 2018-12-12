<?php
session_start();
require ('../../connectmysql.php');

// Valores para iniciar conexion:
$usuario = @$_SESSION['user'];
// Valores para la consulta y tabla
$sub_valor   = $_REQUEST['sub_valor'];
$sub_columna     = $_REQUEST['sub_columna']; 
$sub_variable = $_REQUEST['sub_variable'];
$extra=$_REQUEST['extra'];
?>
<script>
    function vacio(){
        var d = document.getElementById("<?php echo $sub_variable ?>"); 
        d.setAttribute("readonly", "true");
    }
</script>
<!-- Checar si ocupa sub lista o no -->
<?php 
switch ($sub_columna) {
    case 'Ejemplo':
        $sub_columna2= $_REQUEST['sub_columna2'];
        $sub_variable2 = $_REQUEST['sub_variable2'];
        $sub_etiqueta2 = $_REQUEST['sub_etiqueta2'];
        ?>
        <select class = "custom-select" id="<?php echo $sub_variable ?>" onchange = "sub_campos2(this.value,
        '<?php echo $sub_valor ?>',
        '<?php echo $sub_columna2 ?>',
        '<?php echo $sub_variable2 ?>',
        '<?php echo $sub_etiqueta2 ?>')">
        <?php 
        break;
    default:
        ?>
        <select class = "custom-select" id="<?php echo $sub_variable ?>">
        <?php
        break;
}
?>
<!-- Lista principal -->
<?php
if($sub_valor=="")
{
    echo "<option value=''>Selecciona otra opcion</option>";
}
switch ($sub_columna) {
    case 'ciudad':
        $sql = "call j_md_cd('$sub_valor');";
        break;
}
$result = mysqli_query($dbcon, $sql);
$filas=mysqli_num_rows($result);
if ($filas!=0) {
    if($extra!='')
    {
        echo "<option value='$extra'>$extra</option>";
    }
    else
    {
        switch ($sub_columna) {
        case 'ciudad':
        echo "<option value=''>Selecciona una ciudad</option>";
        break;
        default:
        echo "<option value=''>-</option>";
        break;
        }
    }
    while ($valores = mysqli_fetch_row($result)) {
        echo "<option value='$valores[0]'>$valores[0]</option>";
    }
}
else
{
    switch ($sub_columna) {
    case 'Sucursales':
        echo "<option value='' readonly>No hay sucursales disponibles</option>";
        echo "<script>vacio()</script>";
        break;
    }
}
?>
</select>