<?php
require_once('../BOL/docentesCursos.php');
require_once('../DAO/docentesCursosDAO.php');

$dc = new docentesCursos();
$dcDAO = new docentesCursosDAO();

// aqui mostraremos los cursos en el combobox
$data_docentes=$dcDAO->cargarDocentes(); 
$data_cursos=$dcDAO->cargarCursos(); 

if(isset($_POST['guardar']))
{
	$dc->__SET('Cod_Persona',         	$_POST['id_persona']);
	$dc->__SET('Cod_Curso',        	 	$_POST['id_curso']);

	$dcDAO->Registrar($dc);
	header('Location: frmDocentesCursos.php');
}

if(isset($_POST['regresar']))
{
	header('Location: ../procesos_AsignacionDocente.php');
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Asignación Docentes y Cursos</title>
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
                            <th style="text-align:left;">Docentes:</th>
							<td>
								<select name="id_persona" style="width:100%;">
											<?php foreach ($data_docentes as $row){
												echo 
													'<option value="'.$row['Cod_Persona'].'">'.$row['Datos'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

 
						<tr>
                            <th style="text-align:left;">Cursos:</th>
							<td>
								<select name="id_curso" style="width:100%;">
											<?php foreach ($data_cursos as $row){
												echo 
													'<option value="'.$row['Cod_Cursos'].'">'.$row['Descripcion'].'</option>';
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
					$dc->__SET('COD_PERSONA',          $_POST['id_persona']);
					$resultado = $dcDAO->Listar($dc); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">DATOS DEL DOCENTE</th>
												<th style="text-align:left;">CURSOS</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('COD_PERSONA'); ?></td>
										<td><?php echo $r->__GET('DATOS'); ?></td>
										<td><?php echo $r->__GET('DESCRIPCION'); ?></td>
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
