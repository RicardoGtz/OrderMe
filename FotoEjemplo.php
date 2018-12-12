<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <form action="foto_post.php" method="POST" enctype="multipart/form-data">
            <table width="350" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000000">
                <tr>
                    <td height="85" align="center" valign="middle" bgcolor="#FFFFFF">
                        <div align="center">
                            <input name="imagen" type="file" maxlength="150" onchange="loadFile(event)">
                            <img id="output" width="200" height="200"/>
                            <script>
                              var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                              };
                            </script>
                            <br><br>
                            <input type="submit" value="Agregar" name="enviar" style="cursor: pointer">
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
