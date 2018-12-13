<!DOCTYPE html>
<html lang="es">
<head>
	<title>Selecciona sucursal - OrderMe</title>
	<?php include('includes/links.php'); ?>
</head>
<?php
error_reporting(0);
	include('includes/global.php');
	crearHeaders();
	/*session_start();
    if (@$_SESSION['user'] == 'administradorR'){
    	crearHeaders();
    }
    else{
      header("Location:inicio.php");
    }*/
	
?>

<body>
	<div class="contenedor">
		<h1>Seleccion de Sucursal</h1>
		<p></p>
		<p class="centrado">Por favor selecciona la sucursal que prefieras en base a tu localización.</p>
		<div class="contenedor col-md-3 center-block fondoazul">
			<form action="selectSucursal.php" method="POST">
				<p class="letrablanca">Ciudad:</p><?php
	        require ('connectmysql.php'); 
	        $query=@mysqli_query($dbcon,"select * from Ciudad");
	        if(@mysqli_num_rows($query)){
	          $select= '<select name="city">';
	          while($rss=@mysqli_fetch_array($query)){
	            $select.='<option value="'.$rss[0].'"';
	            if(isset($_GET['ciu']))            
	              if(strcmp($rss[0],$_GET['ciu'])==0)              
	                $select.='selected="selected">';
	              else
	                 $select.='>';
	            else
	              $select.='>'; 
	            $select.=$rss[0].'</option>';        
	          }
	        }
	        mysqli_close($dbcon);
	        $select.='</select>';
	        echo $select;  
	        ?>
          <p class="letrablanca">Estado:</p><?php
          require ('connectmysql.php'); 
          $query=@mysqli_query($dbcon,"select * from Ciudad");
          if(@mysqli_num_rows($query)){
            $select= '<select name="state">';
            while($rss=@mysqli_fetch_array($query)){
              $select.='<option value="'.$rss[1].'"';
              if(isset($_GET['sta']))            
                if(strcmp($rss[1],$_GET['sta'])==0)              
                  $select.='selected="selected">';
                else
                   $select.='>';
              else
                $select.='>'; 
              $select.=$rss[1].'</option>';        
            }
          }
          mysqli_close($dbcon);
          $select.='</select>';
          echo $select;  
          ?>

          <p class="letrablanca">Sucursal:</p><?php
          $c=trim($_POST['city']);
          $s=trim($_POST['state']);
          require ('connectmysql.php'); 
          $query=@mysqli_query($dbcon,"select id_sucursal, nombre,direccion,telefono from Sucursal where ciudad = '".$c."' and estado = '".$s."'");
          if(@mysqli_num_rows($query)){
            $select= '<select name="suc">';
            while($rss=@mysqli_fetch_array($query)){
              $select.='<option value="'.$rss[0].'"';
              if(isset($_GET['succc']))            
                if(strcmp($rss[0],$_GET['succc'])==0)              
                  $select.='selected="selected">';
                else
                   $select.='>';
              else
                $select.='>'; 
              $select.=$rss[1].'</option>';        
            }
          }
          mysqli_close($dbcon);
          $select.='</select>';
          echo $select;  
          $succ = trim($_POST['suc']);
          ?>

				<input type="submit" value="Seleccionar" class="btn btn-success btn-primary">

			</form>
		</div>
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Seleccionar</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include('connectmysql.php');

            $sqldata= mysqli_query($dbcon,"select id_sucursal, nombre,direccion,telefono from Sucursal where ciudad = '".$c."' and estado = '".$s."'");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              echo "<tr><td>";
              echo utf8_encode($row[1]);
              echo "</td><td>";
              echo utf8_encode($row[2]);
              echo "</td><td>";
              echo utf8_encode($row[3]);
              echo "</td>";
              echo "<td><a href='ordenInsert.php?id=$row[0]'><img src='comun/img/sistema/map.png' class='img-rounded'></td>";
            }
          ?>
        </tbody>
      </table>
    </table>
  </div>
	<p></p>
	</div>
	
</body><?php include('includes/footer.html'); ?>
</html>
