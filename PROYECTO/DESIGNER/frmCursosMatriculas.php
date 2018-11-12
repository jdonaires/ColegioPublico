<?php
require_once('../BOL/CursoMatricula.php');
require_once('../DAO/CursoMatriculaDAO.php');

$cap = new Curso_Matricula();
$capDAO = new Curso_MatriculaDAO();

// aqui mostraremos los cursos en el combobox
$data=$capDAO->cargarCursos(); 
$data2=$capDAO->cargarMatriculados(); 
$data3=$capDAO->cargarDocentes(); 

if(isset($_POST['guardar']))
{
	$cap->__SET('Cod_Matricula',         	$_POST['id_matricula']);
	$cap->__SET('Cod_Persona',        	 	$_POST['id_persona']);
	$cap->__SET('Cod_Cursos', 				$_POST['id_curso']);

	$capDAO->Registrar($cap);
	header('Location: frmCursosMatriculas.php');
}

if(isset($_POST['regresar']))
{
    header('Location: ../procesos_registroEstudiantes.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Matriculas y Cursos</title>
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
                            <th style="text-align:left;">Estudiante:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_matricula" style="width:100%;">
											<?php foreach ($data2 as $row){
												echo 
													'<option value="'.$row['Cod_Matricula'].'">'.$row['matriculado'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Profesor:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_persona" style="width:100%;">
											<?php foreach ($data3 as $row){
												echo 
													'<option value="'.$row['Cod_persona'].'">'.$row['docentes'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Curso:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_curso" style="width:100%;">
											<?php foreach ($data as $row){
												echo 
													'<option value="'.$row['cod_cursos'].'">'.$row['descripcion'].'</option>';
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
					$cap->__SET('Cod_Matricula',          $_POST['id_matricula']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $capDAO->Listar($cap); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Estudiante</th>
												<th style="text-align:left;">Docente</th>
												<th style="text-align:left;">Curso</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('COD_MATRICULA'); ?></td>
										<td><?php echo $r->__GET('ESTUDIANTE'); ?></td>
										<td><?php echo $r->__GET('DOCENTE'); ?></td>
										<td><?php echo $r->__GET('CURSO'); ?></td>
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
