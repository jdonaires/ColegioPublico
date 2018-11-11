<?php
require_once('../BOL/Personas.php');
require_once('../DAO/PersonasDAO.php');
require_once('../BOL/TD_Personas.php');
require_once('../DAO/TD_PersonasDAO.php');
require_once('../BOL/Estudiantes.php');
require_once('../DAO/EstudiantesDAO.php');

// Personas
$per = new Personas();
$perDAO = new PersonasDAO();

//Cargamos el combobox de los Distritos
$data_dis=$perDAO->cargarDistritos();

//Tipos Documentos Personas
$tdp = new TD_Personas();
$tdpDAO = new TD_PersonasDAO();

//Cargamos el combobox de los Tipos_Documentos
$data_tip=$tdpDAO->cargarTipo_Documentos();

//Docentes
$est = new Estudiantes();
$estDAO = new EstudiantesDAO();

//Cargamos el combobox de las discapacidades
$data_disca=$estDAO->cargarDiscapacidades();

if(isset($_POST['guardar']))
{
	$per->__SET('Ape_Paterno',          $_POST['ape_pat']);
	$per->__SET('Ape_Materno',          $_POST['ape_mat']);
	$per->__SET('Nombres',          	$_POST['nombre']);
	$per->__SET('Sexo',         		$_POST['sexo']);
	$per->__SET('Estado_Civil',         $_POST['estado_civil']);
	$per->__SET('Fecha_Nac',          	$_POST['Fecha_nac']);
	$per->__SET('Direccion',          	$_POST['direccion']);
	$per->__SET('Telefono',          	$_POST['telefono']);
	$per->__SET('Correo',          		$_POST['correo']);
	$per->__SET('Cod_distrito',         $_POST['id_distrito']);

	$perDAO->Registrar($per);

	$tdp->__SET('Cod_Documento',        $_POST['id_tipodoc']);
	$tdp->__SET('Numero_Identidad',     $_POST['num_identidad']);
	
	$tdpDAO->Registrar($tdp);


	$est->__SET('N_Hermanos',          		$_POST['n_her']);
	$est->__SET('Lugar_Ocupa',          	$_POST['l_ocu']);
	$est->__SET('Religion',          		$_POST['reli']);
	$est->__SET('saanee',    				$_POST['sane']);
	$est->__SET('Frecuencia_saanee',  		$_POST['f_sane']);
	$est->__SET('Cod_Discapacidad',         $_POST['id_discapacidad']);
	$est->__SET('Cod_Estudiante',          	$_POST['n_estudiante']);

	$estDAO->Registrar($est);
	header('Location: frmProceso_Estudiantes.php');

}

if(isset($_POST['regresar']))
{
    header('Location: ../procesos_registroEstudiantes.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Proceso de Estudiantes</title>
        <!-- <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">-->
        <link rel="stylesheet" type="text/css" href="css/pure-min.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <script>
	            $(document).ready(function () {
	                $('#fecha1').datepicker({
	                    format: "yyyy/mm/dd"
	                });  
	            });
	    </script>
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
                            <th style="text-align:left;">Ape Paterno:</th>
                            <td><input type="text" name="ape_pat" value="" style="width:100%;" /></td>
                        </tr>
                         <tr>
                            <th style="text-align:left;">Ape Materno:</th>
                            <td><input type="text" name="ape_mat" value="" style="width:100%;"  /></td>
                        </tr>
                         <tr>
                            <th style="text-align:left;">Nombres:</th>
                            <td><input type="text" name="nombre" value="" style="width:100%;"  /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Sexo:</th>
                            <td><input type="radio" name="sexo" value="M"> Masculino
  						        <input type="radio" name="sexo" value="F"> Femenino
  							</td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Estado Civil:</th>
                            <td> 
                            	<select name="estado_civil" style="width:100%;">
							  		<option value="Soltero">Soltero</option>
							  		<option value="Casado">Casado</option>
							  		<option value="Comprometido">Comprometido</option>
							  		<option value="Divorciado">Divorciado</option>
							  		<option value="Viudo">Viudo</option>
								</select> 
							</td>
                        </tr>

                         <tr>
                            <th style="text-align:left;">Fecha Nacimiento:</th>
                            <td><input type="date" id="fecha1" name="Fecha_nac" value="" style="width:100%;" /></td>
                        </tr>
                         <tr>
                            <th style="text-align:left;">Direccion:</th>
                            <td><input type="text" name="direccion" value="" style="width:100%;"  /></td>
                        </tr>
                         <tr>
                            <th style="text-align:left;">Telefono:</th>
                            <td><input type="text" name="telefono" value="" style="width:100%;" /></td>
                        </tr>
                         <tr>
                            <th style="text-align:left;">Correo:</th>
                            <td><input type="text" name="correo" value="" style="width:100%;"  /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Distrito:</th>
                            <td>
                                <select name="id_distrito" style="width:100%;">
                                            <?php foreach ($data_dis as $row){
                                                echo 
                                                    '<option value="'.$row['cod_distrito'].'">'.$row['descripcion'].'</option>';
                                            } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Documento de Identidad:</th>
                            <td>
                                <select name="id_tipodoc" style="width:100%;">
                                            <?php foreach ($data_tip as $row){
                                                echo 
                                                    '<option value="'.$row['Cod_Documento'].'">'.$row['Descripcion'].'</option>';
                                            } ?>
                                </select>
                            </td>
                        </tr>

                         <tr>
                            <th style="text-align:left;">Numero de Identidad:</th>
                            <td><input type="text" name="num_identidad" value="" style="width:100%;" /></td>
                        </tr>



						<tr>
                            <th style="text-align:left;">Nro. de Hermanos:</th>
                            <td><input type="text" name="n_her" value="" style="width:100%;" /></td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Lugar que ocupa:</th>
                            <td><input type="text" name="l_ocu" value="" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Religion:</th>
                            <td><input type="text" name="reli" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">¿Cuenta con apoyo SAANEE?:</th>
                            <td colspan="2">
                                <input type="radio" name="sane" value="SI"> SI
                                <input type="radio" name="sane" value="NO"> NO
  							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Frecuencia de visita al SAANEE:</th>
                            <td>
                                <input type="radio" name="f_sane" value="SEMANAL"> SEMANAL
                                <input type="radio" name="f_sane" value="QUINCENAL"> QUINCENAL
                                <input type="radio" name="f_sane" value="MENSUAL"> MENSUAL
                                <input type="radio" name="f_sane" value="NINGUNA"> NINGUNA
  							</td>
                        </tr>
						
 						<tr>
                            <th style="text-align:left;">Nro. Carnet Estudiante:</th>
                            <td><input type="text" name="n_estudiante" style="width:100%;" maxlength="14" /></td>
                        </tr>
						
						<tr>
                            <th style="text-align:left;">Discapacidad:</th>
                            <td>
                                <select name="id_discapacidad" style="width:100%;">
                                            <?php foreach ($data_disca as $row){
                                                echo 
                                                    '<option value="'.$row['Cod_Discapacidad'].'">'.$row['Descripcion'].'</option>';
                                            } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
                                <input type="submit" value="REGRESAR" name="regresar"class="pure-button pure-button-primary">
                            </td>
                        </tr>

                        <tr>
                        	<td>
                        		<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary" style="width:80%;">
							</td>
                            <td>
                                <select name="id_doc" style="width:100%;">
                                            <?php foreach ($data_tip as $row){
                                                echo 
                                                    '<option value="'.$row['Cod_Documento'].'">'.$row['Descripcion'].'</option>';
                                            } ?>
                                </select>
								
								<input type="text" name="num_iden" value="" style="width:100%;" />

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
					$est->__SET('COD_DOCUMENTO',          $_POST['id_doc']);//ESTABLECEMOS EL VALOR DEL DNI
					$est->__SET('NUMERO_IDENTIDAD',          $_POST['num_iden']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $estDAO->Listar($est); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">CODIGO</th>
												<th style="text-align:left;">DATOS</th>
												<th style="text-align:left;">TIPO DOCUMENTO</th>
												<th style="text-align:left;">N° IDENTIDAD</th>
												<th style="text-align:left;">NRO. HERMANOS</th>
												<th style="text-align:left;">LUGAR QUE OCUPA</th>
												<th style="text-align:left;">RELIGION</th>
												<th style="text-align:left;">APOYO DEL SAANE</th>
												<th style="text-align:left;">FRECUENCIA AL SAANEE</th>
												<th style="text-align:left;">DESCRIPCION DISCAPACIDAD</th>
												<th style="text-align:left;">NRO CARNET ESTUDIANTE</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('COD_PERSONA'); ?></td>
										<td><?php echo $r->__GET('DATOS'); ?></td>
										<td><?php echo $r->__GET('TIPO_DOCUMENTO'); ?></td>
										<td><?php echo $r->__GET('NUMERO_IDENTIDAD'); ?></td>
										<td><?php echo $r->__GET('N_HERMANOS'); ?></td>
										<td><?php echo $r->__GET('LUGAR_OCUPA'); ?></td>
										<td><?php echo $r->__GET('RELIGION'); ?></td>
										<td><?php echo $r->__GET('SAANEE'); ?></td>
										<td><?php echo $r->__GET('FRECUENCIA_SAANEE'); ?></td>
										<td><?php echo $r->__GET('DESCRIPCION'); ?></td>
										<td><?php echo $r->__GET('COD_ESTUDIANTE'); ?></td>
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
