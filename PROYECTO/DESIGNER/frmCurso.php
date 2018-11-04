<?php
require_once('../BOL/curso.php');
require_once('../DAO/cursoDAO.php');

$per = new Curso();
$perDAO = new CursoDAO();

if(isset($_POST['guardar']))
{
	$per->__SET('cod_cursos',           $_POST['cod_cursos']);
	$per->__SET('descripcion',          $_POST['descripcion']);
	$per->__SET('n_capacidades',        $_POST['n_capacidades']);
	$per->__SET('estado', 				$_POST['estado']);

	$perDAO->Registrar($per);
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
                    	<!-- esto es un comentario en Html
						Con respecto a estas lineas se ha implementado para ingresar el codi
						go del curso
                    	-->
                    	<tr>
                            <th style="text-align:left;">Codigo:</th>
                            <td><input type="text" name="cod_cursos" value="" style="width:100%;" required="Ingrese codigo" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Descripcion:</th>
                            <td><input type="text" name="descripcion" value="" style="width:100%;" required="ingrese descripcion" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">N° capacidades:</th>
                            <td><input type="text" name="n_capacidades" value="" style="width:100%;" required /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Estado:</th>
                            <td><input type="text" name="estado" value="" style="width:100%;" required /></td>
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

				<!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->

				<?php
				if(isset($_POST['buscar']))
				{
					$resultado = array();//VARIABLE TIPO RESULTADO
					$per->__SET('dni',          $_POST['dni']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $perDAO->Listar($per); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Nombres</th>
												<th style="text-align:left;">Apellidos</th>
												<th style="text-align:left;">DNI</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('id'); ?></td>
										<td><?php echo $r->__GET('nombres'); ?></td>
										<td><?php echo $r->__GET('apellidos'); ?></td>
										<td><?php echo $r->__GET('dni'); ?></td>
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
