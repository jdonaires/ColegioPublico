<?php
require_once('../BOL/ambientes.php');
require_once('../DAO/ambientesDAO.php');

$amb = new Ambientes();
$ambDAO = new AmbientesDAO();

// aqui mostraremos los cursos en el combobox
$data=$ambDAO->cargarTiposAmbientes(); 
$data1=$ambDAO->cargarInstituciones(); 

if(isset($_POST['guardar']))
{
	$amb->__SET('descripcion',         		$_POST['descripcion']);
	$amb->__SET('ubicacion',        	 	$_POST['ubicacion']);
	$amb->__SET('aforo', 				 	$_POST['aforo']);
	$amb->__SET('area',         		 	$_POST['area']);
	$amb->__SET('estado',        			$_POST['estado']);
	$amb->__SET('cod_tipoambiente', 		$_POST['id_ambiente']);
	$amb->__SET('cod_institucion', 			$_POST['id_institucion']);

	$ambDAO->Registrar($amb);
	header('Location: frmAmbientes.php');
}

if(isset($_POST['regresar']))
{
	header('Location: ../procesos_registroambientes.php');
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Ambientes</title>
        <link rel="stylesheet" type="text/css" href="css/pure-min.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
                            <th style="text-align:left;">Descripcion:</th>
                            <td><input type="text" name="descripcion" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Ubicacion:</th>
                            <td><input type="text" name="ubicacion" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Aforo:</th>
                            <td><input type="text" name="aforo" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Area:</th>
                            <td><input type="text" name="area" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Estado:</th>
                            <td><input type="text" name="estado" value="" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Tipo Ambientes:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_ambiente" style="width:100%;">
											<?php foreach ($data as $row){
												echo 
													'<option value="'.$row['cod_tipoambiente'].'">'.$row['descripcion'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Institucion Esducativa:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_institucion" style="width:100%;">
											<?php foreach ($data1 as $row){
												echo 
													'<option value="'.$row['cod_institucion'].'">'.$row['nombre'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <td colspan="2">
									<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
									<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
									<input type="submit" value="REGRESAR" name="regresar"class="pure-button pure-button-primary">
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
					$amb->__SET('cod_tipoambiente',          $_POST['id_ambiente']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $ambDAO->Listar($amb); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Tipo Ambiente</th>
												<th style="text-align:left;">Descripcion</th>
												<th style="text-align:left;">Ubicacion</th>
												<th style="text-align:left;">Area</th>
												<th style="text-align:left;">Estado</th>
												<th style="text-align:left;">Institucion</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('Cod_ambiente'); ?></td>
										<td><?php echo $r->__GET('tipo_ambiente'); ?></td>
										<td><?php echo $r->__GET('Descripcion'); ?></td>
										<td><?php echo $r->__GET('Ubicacion'); ?></td>
										<td><?php echo $r->__GET('Area'); ?></td>
										<td><?php echo $r->__GET('Estado'); ?></td>
										<td><?php echo $r->__GET('Nombre'); ?></td>
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
