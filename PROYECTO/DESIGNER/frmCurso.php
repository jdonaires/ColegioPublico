<?php
require_once('../BOL/curso.php');
require_once('../DAO/cursoDAO.php');

$cur = new Curso();
$curDAO = new CursoDAO();

if(isset($_POST['guardar']))
{
	$cur->__SET('descripcion',          $_POST['descripcion']);

	$curDAO->Registrar($cur);
	header('Location: frmCurso.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        <!-- <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" ">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:500px;" border="0">
                    	<!-- Esto es un comentario en Html
						Con respecto a estas lineas se ha implementado para ingresar el código del curso
                    	-->
                    	
                        <tr>
                            <th style="text-align:left;">Descripcion:</th>
                            <td><input type="text" name="descripcion" value="" style="width:100%;" required="ingrese descripcion" /></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
								<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
                            </td>
                        </tr>
                    </table>
                </form>


            </div>
        </div>

				<!--Esta condición sirve para realizar búsqueda por el nombre o descripción del curso-->

				<?php
				if(isset($_POST['buscar']))
				{
					$resultado = array(); //Variable de tipo array
					$cur->__SET('Descripcion',          $_POST['descripcion']); //Establecemos el nombre o descrip. del curso
					$resultado = $curDAO->Listar($cur); //Cargamos los registros en el array resultado
					if(!empty($resultado)) //Preguntamos si no el array no está vacío
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">Codigo</th>
												<th style="text-align:left;">Descripcion</th>
												<th style="text-align:left;">N° de Competencias</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //Recorremos el array a través de sus campos
							?>
								<tr>
										<td><?php echo $r->__GET('Cod_Cursos'); ?></td>
										<td><?php echo $r->__GET('Descripcion'); ?></td>
										<td><?php echo $r->__GET('N_Capacidades'); ?></td>
								</tr>
						<?php endforeach;
					}
					else
					{
						echo 'no se encuentra en la base de datos!';
					}
					?>
					</table>
					<?php
				}
				?>

    </body>
</html>
