<?php
require_once('../BOL/Tipo_Ambientes.php');
require_once('../DAO/Tipo_ambientesDAO.php');

$tipo_amb = new Tipo_Ambientes();
$tipo_ambDAO = new Tipo_AmbientesDAO();

if(isset($_POST['guardar']))
{
	$tipo_amb->__SET('descripcion',          $_POST['descripcion']);

	$tipo_ambDAO->Registrar($tipo_amb);
	header('Location: frmTipos_Ambientes.php');
}

if(isset($_POST['regresar']))
{
	header('Location: ../procesos_registroambientes.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Tipos Ambientes</title>
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
                            <th style="text-align:left;">descripcion:</th>
                            <td><input type="text" name="descripcion" value="" style="width:100%;" /></td>
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
					$tipo_amb->__SET('DESCRIPCION',          $_POST['descripcion']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $tipo_ambDAO->Listar($tipo_amb); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">Codigo</th>
												<th style="text-align:left;">Descripcion</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
							<tr>
									<td><?php echo $r->__GET('COD_TIPOAMBIENTE'); ?></td>
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
