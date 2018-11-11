<?php
require_once('../BOL/Personas.php');
require_once('../DAO/PersonasDAO.php');
require_once('../BOL/TD_Personas.php');
require_once('../DAO/TD_PersonasDAO.php');
require_once('../BOL/Docentes.php');
require_once('../DAO/DocentesDAO.php');

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
$doc = new Docentes();
$docDAO = new DocentesDAO();

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


	$doc->__SET('Cargo',          		$_POST['cargo']);
	$doc->__SET('Funcion',          	$_POST['funcion']);
	$doc->__SET('Estado',          		$_POST['estado_civil']);
	$doc->__SET('Nivel_Instruccion',    $_POST['nivel_instruccion']);
	$doc->__SET('Carrera_Profesional',  $_POST['carrera']);
	$doc->__SET('Fecha_inicio',         $_POST['fec_ini']);
	$doc->__SET('Fecha_Fin',          	$_POST['fec_fin']);

	$docDAO->Registrar($doc);
	header('Location: frmProceso_Docentes.php');

}

if(isset($_POST['regresar']))
{
	header('Location: ../procesos_AsignacionDocente.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Proceso de Docentes</title>
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

	    <script>
	            $(document).ready(function () {
	                $('#fecha2').datepicker({
	                    format: "yyyy/mm/dd"
	                });  
	            });
	    </script>

	    <script>
	            $(document).ready(function () {
	                $('#fecha3').datepicker({
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
                            <td>
                            	<input type="radio" name="sexo" value="M"> Masculino
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
                            <th style="text-align:left;">Cargo:</th>
                            <td> 
                            	<select name="cargo" style="width:100%;">
							  		<option value="NO DETERMINADO">NO DETERMINADO</option>
							  		<option value="DIRECTOR">DIRECTOR</option>
							  		<option value="DOCENTE DE AULA">DOCENTE DE AULA</option>
							  		<option value="DOCENTE POR HORAS">DOCENTE POR HORAS</option>
							  		<option value="DOCENTE POR HORAS CONTRATADO">DOCENTE POR HORAS CONTRATADO</option>
							  		<option value="AUXILIAR DE EDUCACION">AUXILIAR DE EDUCACION</option>
							  		<option value="AUXILIAR DE BIBLIOTECA">AUXILIAR DE BIBLIOTECA</option>
							  		<option value="DOCENTE DE AULA CONTRATADO">DOCENTE DE AULA CONTRATADO</option>
							  		<option value="COORDINADOR">COORDINADOR</option>
							  		<option value="REGISTRADOR">REGISTRADOR</option>
							  		<option value="DUBDIRECTOR">DUBDIRECTOR</option>
							  		<option value="PROMOTOR">PROMOTOR</option>
							  		<option value="OTROS">OTROS</option>
								</select> 
							</td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Función:</th>
                            <td> 
                            	<select name="funcion" style="width:100%;">
							  		<option value="SIN FUNCION ESPECIAL">SIN FUNCION ESPECIAL</option>
							  		<option value="RESPONSABLE DE MATRICULA">RESPONSABLE DE MATRICULA</option>
								</select> 
							</td>
                        </tr>

                        <tr>
                            <!-- <th style="text-align:left;">Estado:</th> -->
                            <td><input type="text" hidden="" name="estado" value="1" style="width:100%;" /></td>
                        </tr>


						<tr>
                            <th style="text-align:left;">Nivel Instruccion:</th>
                            <td> 
                            	<select name="nivel_instruccion" style="width:100%;">
							  		<option value="NINGUNO">NINGUNO</option>
							  		<option value="PRIMARIA INCOMPLETA">PRIMARIA INCOMPLETA</option>
							  		<option value="PRIMARIA COMPLETA">PRIMARIA COMPLETA</option>
							  		<option value="SECUNDARIA INCOMPLETA">SECUNDARIA INCOMPLETA</option>
							  		<option value="SECUNDARIA COMPLETA">SECUNDARIA COMPLETA</option>
							  		<option value="SUPERIOR NO UNIV. INCOMPLETA">SUPERIOR NO UNIV. INCOMPLETA</option>
							  		<option value="SUPERIOR NO UNIV. COMPLETA">SUPERIOR NO UNIV. COMPLETA</option>
							  		<option value="SUPERIOR UNIV. INCOMPLETA">SUPERIOR UNIV. INCOMPLETA</option>
							  		<option value="SUPERIOR UNIV. COMPLETA">SUPERIOR UNIV. COMPLETA</option>
							  		<option value="SUPERIOR POST GRADUADO">SUPERIOR POST GRADUADO</option>
								</select> 
							</td>
                        </tr>


                         <tr>
                            <th style="text-align:left;">Carrera Profesional:</th>
                            <td><input type="text" name="carrera" value="" style="width:100%;" /></td>
                        </tr>
                         <tr>
                            <th style="text-align:left;">Fecha Inicio:</th>
                            <td><input type="date" id="fecha2" name="fec_ini" value="" style="width:100%;" /></td>
                        </tr>
                         <tr>
                            <th style="text-align:left;">Fecha Fin:</th>
                            <td><input type="date" id="fecha3"  name="fec_fin" value="" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <td>
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary" style="width:100%;"><br><br>
								<input type="submit" value="REGRESAR" name="regresar"class="pure-button pure-button-primary" style="width:100%;"><br><br>
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
					$doc->__SET('COD_DOCUMENTO',          $_POST['id_doc']);//ESTABLECEMOS EL VALOR DEL DNI
					$doc->__SET('NUMERO_IDENTIDAD',          $_POST['num_iden']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $docDAO->Listar($doc); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
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
												<th style="text-align:left;">CARGO</th>
												<th style="text-align:left;">FUNCION</th>
												<th style="text-align:left;">NIVEL INSTRUCCION</th>
												<th style="text-align:left;">CARRERA PROFESIONAL</th>
												<th style="text-align:left;">FECHA INICIO</th>
												<th style="text-align:left;">FECHA FIN</th>
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
										<td><?php echo $r->__GET('CARGO'); ?></td>
										<td><?php echo $r->__GET('FUNCION'); ?></td>
										<td><?php echo $r->__GET('NIVEL_INSTRUCCION'); ?></td>
										<td><?php echo $r->__GET('CARRERA_PROFESIONAL'); ?></td>
										<td><?php echo $r->__GET('FECHA_INICIO'); ?></td>
										<td><?php echo $r->__GET('FECHA_FIN'); ?></td>
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
