<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro - OrderMe</title>
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
<?php
require ('connectmysql.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $errors = array(); 
  $id = trim($_POST['id_empleado']); 
  $nom = trim($_POST['nombre']); 
  $pas = trim($_POST['pass']);
  $cor = trim($_POST['correo']);
  $tel = trim($_POST['telefono']);
  $succ = trim($_POST['suc']);

if (empty($errors)){ 
  if (isset($_POST['update'])) { 
    //$id=trim($_POST['id']);
    $idp=trim($_POST['id']);
    $query="select ActualizarEmpleado('$idp',$id','$nom','$pas','$cor','$tel','$succ') as resp";
    $resultado=@mysqli_query($dbcon,$query);
    $fila=mysqli_fetch_assoc($resultado);
    
    if($fila['resp']==1)
    {
      echo '<h1>Muchas gracias!</h1>
           <p>Sus datos han sido registrados en la base de datos!</p><p><br /></p>';
    }
    else
    {
      if($fila['resp']==-3)
      {
        echo '<h1>Atencion</h1>
              <p>Error en las llaves foraneas</p><p><br /></p>';
      }

      if($fila['resp']==-2)
      {
        echo '<h1>Atencion</h1>
              <p>La llave primaria a actualizar ya existe!</p><p><br /></p>';
      }

      if($fila['resp']==-1)
      {
        echo '<h1>Atencion</h1>
              <p>El registro que deseas modificar no existe!</p><p><br /></p>';
      } 
    } 
  // Cerrar la conexión a la base de datos
    mysqli_close($dbcon);
  }


  if (isset($_POST['Registrar'])) {
      $query="select InsertarEmpleado('$id','$nom','$pas','$cor','$tel','$succ') as resp";
      $res=@mysqli_query($dbcon,$query);
      $row=mysqli_fetch_assoc($res);
     
      if($row['resp']==1){
        echo '<h1>Muchas gracias!</h1>
            <p>Sus datos han sido registrados en la base de datos!</p><p><br /></p>';
      }
      else{
        if($fila['resp']==2)
        {
          echo '<h1>Atencion</h1>
                <p>La Sucursal que has seleccionado no existe!</p><p><br /></p>';
        }
        if($fila['resp']==0)
        {
          echo '<h1>Atencion</h1>
                <p>El registro ya existe!</p><p><br /></p>';
        }
      }
    }
  // Cerrar la conexión a la base de datos
 mysqli_close($dbcon);
  }else 
  { //Reportar los errores
     echo '<h1>Error!</h1>
     <p class="error">Ocurrieron los siguientes errores:<br />';
     foreach ($errors as $msg) 
     {
        echo " - $msg <br />\n";
     }
     echo '</p>
          <p>Por favor intente nuevamente.</p>';
      mysqli_close($dbcon);
  }
}// Fin de acciones cuando se envía el formulario

?>
<body>
	<div class="contenedor">
		<h1>Registro de Empleados</h1>
		<p></p>
		<p class="centrado">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema</p>
		<div class="contenedor col-md-3 center-block fondoazul">
			<form action="insertarEmp.php" method="POST">
				<p>ID del Empleado:</p><input type="text" name="id_empleado" required maxlength="7" value="<?php 
		        if(!isset($_GET['id'])){
		          if (isset($_POST['id_empleado'])) {
		            echo $_POST['id_empleado']; }
		        } else 
		        echo $_GET['id'];
		        ?>"><br>
				<p>Nombre del Empleado:</p><input type="text" name="nombre" required maxlength="40" value="<?php 
		        if(!isset($_GET['nom'])){
		          if (isset($_POST['nombre'])) {
		            echo $_POST['nombre']; }
		        } else 
		        echo $_GET['nom'];
		        ?>"><br>
				<p>Password:</p><input type="text" name="pass" required maxlength="10" value=""><br>
				<p>Correo:</p><input type="text" name="correo" required maxlength="40" value="<?php 
		        if(!isset($_GET['cor'])){
		          if (isset($_POST['correo'])) {
		            echo $_POST['correo']; }
		        } else 
		        echo $_GET['cor'];
		        ?>"><br>
				<p>Telefono:</p><input type="text" name="telefono" maxlength="10" required pattern="[0-9]+" value="<?php 
		        if(!isset($_GET['tel'])){
		          if (isset($_POST['telefono'])) {
		            echo $_POST['telefono']; }
		        } else 
		        echo $_GET['tel'];
		        ?>"><br>
				
				<p class="letrablanca">Sucursal:</p><?php
			        require ('connectmysql.php'); 
			        $query=@mysqli_query($dbcon,"call VerSucursalRestaurante('adm0004')");
			        if(@mysqli_num_rows($query)){
			          $select= '<select name="suc">';
			          while($rss=@mysqli_fetch_array($query)){
			            $select.='<option value="'.$rss[0].'"';
			            if(isset($_GET['succc']))            
			              if(strcmp($rss[1],$_GET['succc'])==0)              
			                $select.='selected="selected">';
			              else
			                 $select.='>';
			            else
			              $select.='>'; 
			            $select.=$rss[1].", ".$rss[2].'</option>';        
			          }
			        }else{
			        	echo "raioz";
			        }
			        mysqli_close($dbcon);
			        $select.='</select>';
			        echo $select;  
			        ?>

				<input type="submit" value="Registrar" class="btn btn-success btn-primary">
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
