<?php
require_once('../BOL/competencias.php');
require_once('../DAO/competenciasDAO.php');

$cap = new Competencias();
$capDAO = new CompetenciasDAO();

// aqui mostraremos los cursos en el combobox
$data=$capDAO->cargarCursos(); 

if(isset($_POST['guardar']))
{
	$cap->__SET('descripcion',         		 $_POST['descripcion']);
	$cap->__SET('justificacion',        	 $_POST['justificacion']);
	$cap->__SET('cod_cursos', 				 $_POST['id_curso']);

	$capDAO->Registrar($cap);
	header('Location: frmCompetencias.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
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
                            <th style="text-align:left;">Justificacion:</th>
                            <td><input type="text" name="justificacion" value="" style="width:100%;" /></td>
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
					$cap->__SET('cod_cursos',          $_POST['id_curso']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $capDAO->Listar($cap); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Descripcion Competencia</th>
												<th style="text-align:left;">Justiticacion</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('COD_CAPACIDADES'); ?></td>
										<td><?php echo $r->__GET('DESCRIPCION'); ?></td>
										<td><?php echo $r->__GET('JUSTIFICACION'); ?></td>
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
