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
    case 'ciudad':
        //Lista 3
        $sub_columna2=$_REQUEST['sub_columna2'];
        $sub_variable2 = $_REQUEST['sub_variable2'];
        $etiqueta2 = $_REQUEST['etiqueta2'];

        $sub_columna3=$_REQUEST['sub_columna3'];
        $sub_variable3 = $_REQUEST['sub_variable3'];
        $etiqueta3 = $_REQUEST['etiqueta3'];
        ?>
        <select class = "custom-select" id="<?php echo $sub_variable ?>" onchange = "ciudad('<?php echo $sub_valor ?>',this.value,
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
    case 'restaurante':
        //Lista 3 id1,id2,id3,sc,sv,se,x
        $sub_columna2=$_REQUEST['sub_columna2'];
        $sub_variable2 = $_REQUEST['sub_variable2'];
        $etiqueta2 = $_REQUEST['etiqueta2'];

        $sub_valor1   = $_REQUEST['sub_valor1'];
        $sub_valor2   = $_REQUEST['sub_valor2'];
        ?>
        <select class = "custom-select" id="<?php echo $sub_variable ?>" onchange = "sucursal(
            '<?php echo $sub_valor1 ?>',
            '<?php echo $sub_valor2 ?>',
            this.value,
            '<?php echo $sub_columna2 ?>',
            '<?php echo $sub_variable2 ?>',
            '<?php echo $etiqueta2 ?>',
            ''
        )">
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
        $sql = "call VerCiudadEstado('$sub_valor');";
        break;
    case 'restaurante':
        $sub_valor1   = $_REQUEST['sub_valor1'];
        $sub_valor2   = $_REQUEST['sub_valor2'];
        $sql = "call VerRestauranteCiudad('$sub_valor2','$sub_valor1');";
        break;
    case 'sucursal':
        $sub_valor1   = $_REQUEST['sub_valor1'];
        $sub_valor2   = $_REQUEST['sub_valor2'];
        $sub_valor3   = $_REQUEST['sub_valor3'];
        $sql = "call VerSucursalCiudad('$sub_valor3','$sub_valor2','$sub_valor1');";
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
        switch ($sub_columna) {
            case 'restaurante':
                echo "<option value='$valores[0]'>$valores[1]</option>";
                break;
            default:
                echo "<option value='$valores[0]'>$valores[0]</option>";
            break;
        }
        
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

<script>
    function ciudad(id1,id2,sc,sv,se,sc2,sv2,se2,x) {
        alertify.error(id1 + "|" + id2 + "|" + sc);
        $(se).load("includes/lista/sub_lista.php",
            {
             sub_valor:id1,
             sub_valor1:id1,
             sub_valor2:id2,
             sub_columna:sc,
             sub_variable:sv,
             sub_etiqueta:se,

             sub_columna2:sc2,
             sub_variable2:sv2,
             etiqueta2:se2,

             extra:x
         });
    }

    function sucursal(id1,id2,id3,sc,sv,se,x) {
        alertify.error(id1 + "|" + id2 + "|" + id3 + "|" + sc);
        $(se).load("includes/lista/sub_lista.php",
            {
             sub_valor:id1,
             sub_valor1:id1,
             sub_valor2:id2,
             sub_valor3:id3,

             sub_columna:sc,
             sub_variable:sv,
             sub_etiqueta:se,

             extra:x
         });
    }


    function sub_lista_3(id,sc,sv,se,x) {
        $(se).load("componentes/sub_lista.php",
            {sub_valor:id,
             sub_columna:sc,
             sub_variable:sv,
             sub_etiqueta:se,
             extra:x
         });
    }
    function sub_campos(id,c,v,e) {
        $(e).load("componentes/sub_campo.php",{columna:c,sub_valor:id,variable:v});
    }
    function sub_campos2(id2,id,sc,sv,se) {
        $(se).load("componentes/sub_campo.php",
            {sub_valor2:id2,
             sub_valor:id,
             columna:sc,
             variable:sv
         });
    }
    function lista_3(id2,id,sc,sv,se,x) {
        $(se).load("componentes/sub_lista.php",
            {sub_valor2:id2, 
             sub_valor:id,
             sub_columna:sc,
             sub_variable:sv,
             sub_etiqueta:se,
             extra:x
         });
    }
</script>