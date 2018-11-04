<?php
require_once('../BOL/instituciones.php');
require_once('../DAO/institucionesDAO.php');
require_once('../DAO/tipos_ieDAO.php');

$ints = new Instituciones();
$instDAO = new InstitucionesDAO();

// Instanciamos la clase Tipo_InstitucionesDAO
$tip = new Tipos_IEDAO();
// Cargamos el comboobx departamentos
$departamento=$tip->cargarDepartamento();

    $d= $_POST['servicio'];
    // cargamos el combo distrito mediante la variable anterior
    $provin = $tip->cargarProvincia($d);

    // obtenemos el name de la provincia seleccionado
    $p= $_POST['nom_provincia'];
    // cargamos el combo distrito mediante la variable anterior
    $dis = $tip->cargarDistritos($p);

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        <!-- <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" ">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	</head>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->

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
                            <th style="text-align:left;">Departamento:</th>
                            <td>
                                
								<select name="servicio" id="servicio" onchange="mostrarprecio()"  style="width:100%;">
                                    <option value="">---Seleccione---</option>
											<?php foreach ($departamento as $row){
												echo 
													'<option value="'.$row['cod_departamento'].'">'.$row['descripcion'].'</option>';
											} ?>
								</select>
                            <!--
                                <input hidden id="servicioSelecionado" name="nom_Servicio" >
                                <input type="submit" value="ver" name="buscar1" class="pure-button pure-button-primary">
                            -->
							</td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Provincia:
                            <td>
                               
                                <select name="servicio2" id="servicio2" onchange="mostrarprecio2()" style="width:100%;">
                                            <?php foreach ($provin as $row){
                                                echo 
                                                    '<option value="'.$row['cod_provincia'].'">'.$row['descripcion'].'</option>';
                                            } ?>
                                </select>
                             <!--
                                <input hidden id="provinciaSelecionado" name="nom_provincia" >
                                <input type="submit" value="ver" name="buscar2" class="pure-button pure-button-primary">
                            -->
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Distrito:</th>
                            <td>
                                <select name="cod_distrito" style="width:100%;">
                                            <?php foreach ($dis as $row){
                                                echo 
                                                    '<option value="'.$row['cod_distrito'].'">'.$row['descripcion'].'</option>';
                                            } ?>
                                </select>
                            </td>
                        </tr>
                            
                            <input type="text" id="precio" name="nom_Servicio" />

                            <input type="submit" value="ver" name="buscar1" class="pure-button pure-button-primary">

                            <input type="text" id="precio2" name="nom_provincia" />

                            <input type="submit" value="ver" name="buscar2" class="pure-button pure-button-primary">
                    </table>

                </form>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        function mostrarprecio() {
            var pizza = document.getElementById("servicio"),
            precio = document.getElementById("precio");
            precio.value = pizza.value;
        }
    </script>

    <script type="text/javascript">
        function mostrarprecio2() {
            var pizza1 = document.getElementById("servicio2"),
            precio1 = document.getElementById("precio2");
            precio1.value = pizza1.value;
        }
    </script>

</html>