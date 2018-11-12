<?php
require_once('../BOL/tipodocumento.php');
require_once('../DAO/tipodocumentoDAO.php');

$tip = new TipoDocumento();
$tipDAO = new TipoDocumentoDAO();

if(isset($_POST['guardar']))
{
	$tip->__SET('Descripcion',          $_POST['descripcion']);

	$tipDAO->Registrar($tip);
	header('Location: frmTipodocumento.php');
}

if(isset($_POST['regresar']))
{
	header('Location: ../procesos_registroEstudiantes.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Documentos de Identidades</title>
        <!-- <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">-->
        <link rel="stylesheet" type="text/css" href="css/pure-min.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
    <body style="padding:15px;">

			<h2> Documentos de Identidades </h2>

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
					$tip->__SET('Descripcion',          $_POST['descripcion']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $tipDAO->Listar($tip); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
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
										<td><?php echo $r->__GET('Cod_Documento'); ?></td>
										<td><?php echo $r->__GET('Descripcion'); ?></td>
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
