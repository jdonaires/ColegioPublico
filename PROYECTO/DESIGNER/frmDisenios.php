<?php
require_once('../BOL/disenio.php');
require_once('../DAO/disenioDAO.php');

$dis = new Disenio();
$disDAO = new DisenioDAO();


if(isset($_POST['guardar']))
{
	$dis->__SET('descripcion',   $_POST['descripcion']);
	$dis->__SET('anio',        	 $_POST['date']);

	$disDAO->Registrar($dis);
	header('Location: frmDisenios.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">

		<script src="js/bootstrap-datepicker.min.js"></script>
	    <script>
	            $(document).ready(function () {
	                $('#fecha').datepicker({
	                    format: "yyyy/mm/dd"
	                });  
	            });
	    </script>
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
                            <td><input type="text" name="descripcion" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha de Emision:</th>
                            <td><input type="text" id="fecha" name="date" value="" style="width:100%;"  /></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
									<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
									<input type="submit" value="LISTAR" name="buscar"class="pure-button pure-button-primary">
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
					$listado=$disDAO->ListarAll();

				?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Descripcion Curricular</th>
												<th style="text-align:left;">Fecha de Emision</th>
										</tr>
								</thead>
				<?php
						foreach( $listado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r['Cod_DisenioC']; ?></td>
										<td><?php echo $r['Descripcion']; ?></td>
										<td><?php echo $r['Anio']; ?></td>
								</tr>
					<?php endforeach
					?>
					</table>
					<?php
				}
				?>

    </body>
</html>
