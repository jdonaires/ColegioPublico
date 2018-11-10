<?php
require_once('../BOL/Estudiantes.php');
require_once('../DAO/EstudianteDAO.php');

$estu = new Estudiantes();
$estuDAO = new EstudianteDAO();

if(isset($_POST['guardar']))
{
	$estu->__SET('cod_persona',         $_POST['cod_persona']);
	$estu->__SET('n_hermanos',          $_POST['n_hermanos']);
	$estu->__SET('lugar_ocupa',         $_POST['lugar_ocupa']);
	$estu->__SET('religion', 				  	$_POST['religion']);
	$estu->__SET('SAANEE',              $_POST['SAANEE']);
	$estu->__SET('frecuencia_saanee',   $_POST['frecuencia_saanee']);
	$estu->__SET('cod_discapacidad',    $_POST['cod_discapacidad']);
	$estu->__SET('cod_estudiante',      $_POST['cod_estudiante']);
	$estuDAO->Registrar($estu);
	header('Location: frmestudiante.php');
}



?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Estudiante</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">
								<h1>Opciones: Estudiantes</h1>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:500px;" border="0">
											<tr>
													<th style="text-align:left;">Codigo Persona:</th>
													<td><input type="text" name="cod_persona" value="" style="width:100%;" /></td>
											</tr>
                        <tr>
                            <th style="text-align:left;">Numero de Hermanos:</th>
                            <td><input type="text" name="n_hermanos" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Lugar:</th>
                            <td><input type="text" name="lugar_ocupa" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Religion:</th>
                            <td><input type="text" name="religion" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">SAANEE:</th>
                            <td><input type="text" name="SAANEE" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Frecuencia SAANEE:</th>
                            <td><input type="text" name="frecuencia_saanee" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Codigo de discapacidad</th>
                            <td><input type="text" name="cod_discapacidad" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
														<th style="text-align:left;">Codigo de Estudiante</th>
														<td><input type="text" name="cod_estudiante" value="" style="width:100%;" /></td>
												</tr>
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
					$estu->__SET('cod_estudiante',          $_POST['cod_estudiante']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $estuDAO->Buscar($estu); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
											  <th style="text-align:left;">Codigo de persona:</th>
												<th style="text-align:left;">Numero de Hermanos:</th>
												<th style="text-align:left;">Lugar:</th>
												<th style="text-align:left;">Religion:</th>
												<th style="text-align:left;">SAANEE:</th>
												<th style="text-align:left;">Frecuencia SAANEE:</th>
												<th style="text-align:left;">Codigo de discapacidad</th>
												<th style="text-align:left;">Codigo de estudiante:</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('cod_persona'); ?></td>
										<td><?php echo $r->__GET('n_hermanos'); ?></td>
										<td><?php echo $r->__GET('lugar_ocupa'); ?></td>
										<td><?php echo $r->__GET('religion'); ?></td>
										<td><?php echo $r->__GET('SAANEE'); ?></td>
										<td><?php echo $r->__GET('frecuencia_saanee'); ?></td>
										<td><?php echo $r->__GET('cod_discapacidad'); ?></td>
										<td><?php echo $r->__GET('cod_estudiante'); ?></td>
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
