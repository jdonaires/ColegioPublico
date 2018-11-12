<?php
	require_once('../BOL/Evaluaciones.php');
	require_once('../DAO/EvaluacionesDAO.php');

	require_once('../BOL/DetalleEvaluaciones.php');
	require_once('../DAO/DetalleEvaluacionesDAO.php');

	$eva = new Evaluaciones();
	$evaDAO = new EvaluacionesDAO();

	$data1=$evaDAO->cargarAnioEscolar(); 
	$data2=$evaDAO->cargarInstituciones(); 
	$data3=$evaDAO->cargarCursos(); 
	$data4=$evaDAO->cargarGrados(); 
	$data5=$evaDAO->cargarPeriodos(); 
	$data6=$evaDAO->cargarDocentes(); 


	$det = new DetallesEvaluaciones();
	$detDAO = new DetalleEvaluacionesDAO();

	if(isset($_POST['guardar']))
	{
		$eva->__SET('Cod_Persona',          $_POST['id_docente']);
		$eva->__SET('Cod_Curso',          	$_POST['id_curso']);
		$eva->__SET('Fecha',          	 	$_POST['fecha']);
		$eva->__SET('Hora',          		$_POST['hora']);
		$eva->__SET('Cod_Grados',           $_POST['id_grado']);
		$eva->__SET('Cod_Periodos',       	$_POST['id_periodo']);
		$eva->__SET('Cod_Escolar',       	$_POST['id_anio']);
		$eva->__SET('Cod_Institucion',      $_POST['id_institucion']);
		$eva->__SET('Promedio_final',       $_POST['promedio']);

		$evaDAO->Registrar($eva);
		//header('Location: frmCurso_grado.php');

		$det->__SET('calificacion',         $_POST['nota']);
		$det->__SET('Cod_Matricula',       	$_POST['id_matricula']);

		$detDAO->Registrar($det);

		header('Location: frmEvaluaciones.php');
	}

	if(isset($_POST['regresar']))
	{
		header('Location: ../index.php');
	}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Evaluaciones</title>
        <link rel="stylesheet" type="text/css" href="css/pure-min.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
					<table style="width:500px;" border="0">
						
                        <tr>
                            <th style="text-align:left;">Docentes:</th>
							<td>
								<select name="id_docente" style="width:100%;">
											<?php foreach ($data6 as $row){
												echo 
													'<option value="'.$row['cod_persona'].'">'.$row['Tutor'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>


                        <tr>
                            <th style="text-align:left;">Curso:</th>
							<td>
								<select name="id_curso" style="width:100%;">
											<?php foreach ($data3 as $row){
												echo 
													'<option value="'.$row['Cod_Cursos'].'">'.$row['Descripcion'].'</option>';
											} ?>
								</select>
							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Fecha:</th>
                            <td><input type="date" name="fecha" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Hora:</th>
                            <td><input type="time" name="hora" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Grado:</th>
							<td>
								<select name="id_grado" style="width:100%;">
											<?php foreach ($data4 as $row){
												echo 
													'<option value="'.$row['Cod_grados'].'">'.$row['Descripcion'].'</option>';
											} ?>
								</select>
							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Periodo:</th>
							<td>
								<select name="id_periodo" style="width:100%;">
											<?php foreach ($data5 as $row){
												echo 
													'<option value="'.$row['Cod_periodos'].'">'.$row['Descripcion_Periodo'].'</option>';
											} ?>
								</select>
							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Modalidad Evaluativa:</th>
							<td>
								<select name="id_anio" style="width:100%;">
											<?php foreach ($data1 as $row){
												echo 
													'<option value="'.$row['Cod_escolar'].'">'.$row['modalidad_evaluacion'].'</option>';
											} ?>
								</select>
							</td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Institucion Educativa:</th>
							<td>
								<select name="id_institucion" readonly style="width:100%;">
											<?php foreach ($data2 as $row){
												echo 
													'<option value="'.$row['Cod_Institucion'].'">'.$row['Nombre'].'</option>';
											} ?>
								</select>
							</td>
                        </tr>

                        <tr>
                            <td colspan="2">
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
								<input type="submit" value="REGRESAR" name="regresar"class="pure-button pure-button-primary"> <br><br>
                            </td>
                        </tr>

					</table>

					<table class="pure-table pure-table-horizontal" style="width:700px;">
                        <thead>
							<tr>
								<th>Codigo</th>
								<th>Estudiantes</th>
								<th>Criterio Eva. 1</th>
								<th>Promedio Final</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach($detDAO->cargarMatriculadosCursos() as $r){ 	
							?>
							<tr>
								<td><input type="text" name="id_matricula" value="<?php echo $r['Cod_Matricula']; ?>"></td>
                                <td><?php echo $r['matriculado']; ?></td>
                                <td>
                                    <select name="nota" style="width:80%;">
										<option value=""></option>
									 	<option value="AD">AD</option>
									  	<option value="A">A</option>
									  	<option value="B">B</option>
									  	<option value="C">C</option>
									</select> 
								</td>
								<td>
                                    <select name="promedio" style="width:80%;">
										<option value=""></option>
									 	<option value="AD">AD</option>
									  	<option value="A">A</option>
									  	<option value="B">B</option>
									  	<option value="C">C</option>
									</select> 
								</td>
							</tr>
							<?php } ?>
						</tbody>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
