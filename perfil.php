<!DOCTYPE html>
<html lang="es">
<head>
    <title>Sucursales - OrderMe</title>
    <?php include('includes/links.php'); ?>
</head>
<?php
	include('includes/global.php');
	crearHeaders();
?>
<body>
  <div class="contenedor">
    <h1>Registrate</h1>
    <p></p>
    <?php
      require('connectmysql.php');
      $usuario=$_SESSION['usuario'];
      $sqldata= mysqli_query($dbcon,"call VerUsuarioEspecifico('$usuario')");
      $row=mysqli_fetch_array($sqldata,MYSQLI_NUM);
      $nipas="";
      if(isset($_GET['editar'])){
        $nipas = trim($_GET['editar']);
      }
      echo $nipas;
      if (isset($_POST['Actualizar'])) {

          if (empty($_POST['id_usuario']))
          $errors[] = 'Olvido introducir el ID del Usuario';
        else{
          $ni = trim($_POST['id_usuario']);
          $ni = mysqli_real_escape_string($dbcon, $ni);
        }

        if (empty($_POST['nombre']))
          $errors[] = 'Olvido introducir el Nombre del Usuario';
        else{
          $nn = trim($_POST['nombre']);
          $nn = mysqli_real_escape_string($dbcon, $nn);
        }

        if (empty($_POST['correo']))
          $errors[] = 'Olvido introducir el Correo del Usuario';
        else{
          $nc = trim($_POST['correo']);
          $nc = mysqli_real_escape_string($dbcon, $nc);
        }

        if (empty($_POST['pass']))
          $errors[] = 'Olvido introducir la Contraseña';
        else{
          $np = trim($_POST['pass']);
          $np = mysqli_real_escape_string($dbcon, $np);
        }

        if (empty($_POST['telefono']))
          $errors[] = 'Olvido introducir el nombre del usuario';
        else{
          $nt = trim($_POST['telefono']);
          $nt = mysqli_real_escape_string($dbcon, $nt);
        }

        if (empty($_POST['num_tarjeta']))
          $errors[] = 'Olvido introducir el nombre del usuario';
        else{
          $nta = trim($_POST['num_tarjeta']);
          $nta = mysqli_real_escape_string($dbcon, $nta);
        }

        if (empty($_POST['mes']))
          $errors[] = 'Olvido introducir el nombre del usuario';
        else{
          $nm = trim($_POST['mes']);
          $nm = mysqli_real_escape_string($dbcon, $nm);
        }

        if (empty($_POST['anio']))
          $errors[] = 'Olvido introducir el nombre del usuario';
        else{
          $na = trim($_POST['anio']);
          $na = mysqli_real_escape_string($dbcon, $na);
        }

        if (empty($_POST['cvv']))
          $errors[] = 'Olvido introducir el nombre del usuario';
        else{
          $ncvv = trim($_POST['cvv']);
          $ncvv = mysqli_real_escape_string($dbcon, $ncvv);
        }

        if (empty($_POST['titular']))
          $errors[] = 'Olvido introducir el nombre del usuario';
        else{
          $nti = trim($_POST['titular']);
          $nti = mysqli_real_escape_string($dbcon, $nti);
        }
        if (empty($errors)){
          $query="select ActualizarUsuario('$nipas',$ni','$nn','$nc','$np','$nt','$nta','$nm','$na','$ncvv','$nti') as resp";
          $resultado=@mysqli_query($dbcon,$query);
          $fila=mysqli_fetch_assoc($resultado);

          if($fila['resp']==1)
          {
            echo '<h1>Muchas gracias!</h1>
                 <p>Sus datos han sido registrados en la base de datos!</p><p><br /></p>';
          }
          else
          {
            if($fila['resp']==2)
            {
              echo '<h1>Atencion</h1>
                    <p>El registro ya existe!</p><p><br /></p>';
            }else
            {
              echo '<h1>Atencion</h1>
                    <p>El registro que deseas modificar no existe!</p><p><br /></p>';
            }
          }
        // Cerrar la conexión a la base de datos
          mysqli_close($dbcon);
      }
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
      if(isset($_GET['editar'])){
        echo '
        <div class="contenedor col-md-3 center-block fondoazul">
        <form action="perfil.php" method="POST">
          <p>ID:</p><input type="text" name="id_usuario" required maxlength="7" value="
          '.$row[0].'" border="false" ><br>
          <p>Nombre:</p><input type="text" name="nombre" required maxlength="40" value="'.$row[1].'"><br>
          <p>Correo:</p><input type="text" name="correo" required maxlength="40" value="'.$row[2].'"><br>
          <p>Password:</p><input type="password" name="pass" required maxlength="10" value="'.$row[3].'"><br>
          <p>Telefono:</p><input type="text" name="telefono" maxlength="10" required pattern="[0-9]+" value="'.$row[4].'"><br>
          <p>Numero de Tarjeta:</p><input type="text" name="num_tarjeta" maxlength="16" required pattern="[0-9]+" value="'.$row[5].'"><br>
          <p>Mes de Vencimiento:</p><input type="text" name="mes" maxlength="2" required pattern="[0-9]+" value="'.$row[6].'"><br>
          <p>Año de Vencimiento:</p><input type="text" name="anio" maxlength="2" required pattern="[0-9]+" value="'.$row[7].'"><br>
          <p>CVV:</p><input type="text" name="cvv" maxlength="3" required pattern="[0-9]+" value="'.$row[8].'"><br>
          <p>Nombre del Titular:</p><input type="text" name="titular" required maxlength="40" value="'.$row[9].'"><br>
          <input type="submit" value="Actualizar" class="btn btn-success btn-primary>
        </form>
        </div>';
      }else{
        echo '
        <div class="contenedor col-md-3 center-block fondoazul">
        <form action="perfil.php" method="POST">
          <p>ID:</p><input type="text" name="id_usuario" required maxlength="7" value="
          '.$row[0].'" readonly="" border="false" ><br>
          <p>Nombre:</p><input type="text" name="nombre" required maxlength="40" value="'.$row[1].'"readonly=""><br>
          <p>Correo:</p><input type="text" name="correo" required maxlength="40" value="'.$row[2].'"readonly=""><br>
          <p>Password:</p><input type="password" name="pass" required maxlength="10" value="'.$row[3].'"readonly=""><br>
          <p>Telefono:</p><input type="text" name="telefono" maxlength="10" required pattern="[0-9]+" value="'.$row[4].'"readonly=""><br>
          <p>Numero de Tarjeta:</p><input type="text" name="num_tarjeta" maxlength="16" required pattern="[0-9]+" value="'.$row[5].'"readonly=""><br>
          <p>Mes de Vencimiento:</p><input type="text" name="mes" maxlength="2" required pattern="[0-9]+" value="'.$row[6].'"readonly=""><br>
          <p>Año de Vencimiento:</p><input type="text" name="anio" maxlength="2" required pattern="[0-9]+" value="'.$row[7].'"readonly=""><br>
          <p>CVV:</p><input type="text" name="cvv" maxlength="3" required pattern="[0-9]+" value="'.$row[8].'"readonly=""><br>
          <p>Nombre del Titular:</p><input type="text" name="titular" required maxlength="40" value="'.$row[9].'"readonly=""><br>
          <a href="perfil.php?editar='.$row[0].'" "><input type="button" value="Editar" class="btn btn-success btn-primary>
        </form>
        </div>';
      }
    ?>
  <p></p>
  </div>
  <?php include('includes/footer.html'); ?>
</body>
</html>
