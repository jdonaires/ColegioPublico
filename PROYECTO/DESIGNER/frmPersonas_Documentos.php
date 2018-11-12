<?php
require_once('../BOL/personasDocumentos.php');
require_once('../DAO/personasDocumentosDAO.php');

$perdoc = new PersonasDocumentos();
$perdocDAO = new PersonasDocumentosDAO();

// aqui mostraremos los cursos en el combobox
$data_doc=$perdocDAO->CargarTipoDocumentos(); 
$data_per=$perdocDAO->cargarPersonas();

if(isset($_POST['guardar']))
{
	$perdoc->__SET('Cod_Documento',         		$_POST['id_documento']);
	$perdoc->__SET('Cod_Persona',        	 		$_POST['id_persona']);
	$perdoc->__SET('Numero_Identidad', 				$_POST['num_identidad']);

	$perdocDAO->Registrar($perdoc);
	header('Location: frmPersonas_Documentos.php');
}

if(isset($_POST['regresar']))
{
	header('Location: ../procesos_registroEstudiantes.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Personas Documentos</title>
        <link rel="stylesheet" type="text/css" href="css/pure-min.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:700px;" border="0">
                    	<!-- esto es un comentario en Html
						Con respecto a estas lineas se ha implementado para ingresar el codi
						go del curso
                    	-->

                    	<tr>
                            <th style="text-align:left;">Personas Registrada:</th>
							<td>
								<select name="id_persona" style="width:100%;">
											<?php foreach ($data_per as $row){
												echo 
													'<option value="'.$row['Cod_Persona'].'">'.$row['Datos'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Tipo de Documento:</th>
							<td>
								<select name="id_documento" style="width:100%;">
											<?php foreach ($data_doc as $row){
												echo 
													'<option value="'.$row['Cod_Documento'].'">'.$row['Descripcion'].'</option>';
											} ?>
									</select>
								</select>
							</td>
                        </tr>

                       
						<tr>
                            <th style="text-align:left;">Nro. Identidad:</th>
                            <td><input type="text" name="num_identidad" value="" style="width:100%;" /></td>
                        </tr>


                        <tr>
                            <td colspan="2"> 
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
								<input type="submit" value="REGRESAR" name="regresar"class="pure-button pure-button-primary">
                            </td>
                        </tr>

                        <tr>
                        	<td><input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary"></td>
                        	<td>
								<select name="documento" style="width:100%;">
											<?php foreach ($data_doc as $row){
												echo 
													'<option value="'.$row['Cod_Documento'].'">'.$row['Descripcion'].'</option>';
											} ?>
									</select>
								</select>
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
					$perdoc->__SET('Cod_Documento',          $_POST['documento']);
					$resultado = $perdocDAO->Listar($perdoc); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">TIPO DE IDENTIDAD</th>
												<th style="text-align:left;">DATOS DE LA PERSONA</th>
												<th style="text-align:left;">NUMERO DE IDENTIDAD</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('DESCRIPCION'); ?></td>
										<td><?php echo $r->__GET('DATOS'); ?></td>
										<td><?php echo $r->__GET('NUMERO_IDENTIDAD'); ?></td>
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
