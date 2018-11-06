<?php
//BUSCAMOS LAS CARPETAS DONDE SE ENCUENTRA LA CLASE Y LA CONEXION A LA BD 
require_once('../BOL/docente.php');
require_once('../BOL/persona.php');
require_once('../DAO/docenteDAO.php');
require_once('../DAO/personaDAO.php');

// INSTANCIAMOS EL OBJETO DE LAS CLASES Y CREAMOS UN NUEVO OBJETO
$per = new Persona();
$perDAO = new PersonaDAO();

$doc = new Docente();
$docDAO = new DocenteDAO();

//GUARGAR EL REGISTRO DE LA PERSONA
if(isset($_POST['guardar']))
{
    $per->__SET('APE_PATERNO',           $_POST['APE_PATERNO']);
    $per->__SET('APE_MATERNO',           $_POST['APE_MATERNO']);
    $per->__SET('NOMBRES',               $_POST['NOMBRES']);
    $per->__SET('SEXO',                  $_POST['SEXO']);
    $per->__SET('DNI',                   $_POST['DNI']);
    $per->__SET('ESTADO_CIVIL',          $_POST['ESTADO_CIVIL']);
    $per->__SET('FECHA_NAC',             $_POST['FECHA_NAC']);
    $per->__SET('DIRECCION',             $_POST['DIRECCION']);
    $per->__SET('TELEFONO',              $_POST['TELEFONO']);
    $per->__SET('CORREO',                $_POST['CORREO']);
    $doc->__SET('COD_PERSONA',           $_POST['COD_PERSONA']);
    $doc->__SET('CARGO',                 $_POST['CARGO']);
    $doc->__SET('FUNCION',               $_POST['FUNCION']);
    $doc->__SET('ESTADO',                $_POST['ESTADO']);
    $doc->__SET('NIVEL_INSTRUCCION',     $_POST['NIVEL_INSTRUCCION']);
    $doc->__SET('CARRERA_PROFESIONAL',   $_POST['CARRERA_PROFESIONAL']);
    $doc->__SET('FECHA_INICIO',          $_POST['FECHA_INICIO']);
    $doc->__SET('FECHA_FIN',             $_POST['FECHA_FIN']);

    $perDAO->Registrar_per($per);
    $docDAO->Registrar_doc($doc);
    header('Location: frmDocente.php');
}

?>

<!--FORMULARIO PARA REGISTRAR A LA PERSONA Y AL DOCENTE-->
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>REGISTRAR DOCENTES</title>
	</head>
<body style="padding:15px;text-align:center;">

    <!--TITULO DEL FORMULARIO-->
    <h3 style="color: black; text-align:center;">.:REGISTRAR DOCENTE:.</h3>

    <div class="pure-g">
        <div class="pure-u-1-12">

      	<!--FORMULARIO PARA REGISTRAR AL DOCENTE-->	
            <form  class="contacto" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px; text-align:center;">

              	<!--DENTRO DEL FORNNULARIO CREAMOS UNA TABLA PARA REGISTRAR AL DOCENTE-->
                <table style="width: 1300px; text-align:center;">
                        <!--BOTONES - GUARDAR REGISTRO-->
                    <tr>
                        <td align="left" class="boton1"  colspan="2">
                            <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
                            <input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
                            <input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
                        </td>
                    </tr>                   

                    	<!--CAMPOS DE LA TABLA PERSONA Y DOCENTE-->
                    <tr>
                        <th style="text-align:left; padding:10px;">Ape. Paterno:</th>
                        <td><input type="text" name="APE_PATERNO" value="" style="width:100%; text-align:center;" /></td>
                        <th style="text-align:left; padding:10px;">Ape. Materno:</th>
                        <td><input type="text" name="APE_MATERNO" value="" style="width:100%; text-align:center;" /></td>
                        <th style="text-align:left; padding:10px;">Nombres:</th>
                        <td><input type="text" name="NOMBRES" value="" style="width:100%; text-align:center;" /></td>
                    </tr>
                    <tr>
                        <th style="text-align:left; padding:10px;"><label>Sexo:</label></th>
                        <td>
                            <select name="SEXO" style=" width:100%; text-align:center;">
                                <option style="text-align:center;">------</option>
                                <option style="text-align:center;" value="M">Masculino </option>
                                <option style="text-align:center;" value="F"> Femenino</option>
                            </select>
                        </td>
                        <th style="text-align:left; padding:10px;">Dni:</th>
                        <td><input type="text" name="DNI" value="" style="width:100%; background-color: #FDFB94; text-align:center;" /></td>    
                        <th style="text-align:left; padding:10px;"><label>Estado Civil:</label></th>
                        <td>
                            <select name="ESTADO_CIVIL" style=" width:100%; text-align:center;">
                                <option style="text-align:center;">------</option>
                                <option style="text-align:center;" value="Soltero">Soltero</option>
                                <option style="text-align:center;" value="Casado">Casado</option>
                            </select>                       
                    </tr>
                    <tr>
                        <th style="text-align:left; padding:10px;">Direccion:</th>
                        <td><input type="text" name="DIRECCION" value="" style="width:100%; text-align:center;" /></td>
                        <th style="text-align:left; padding:10px;">Telefono:</th>
                        <td><input type="text" name="TELEFONO" value="" style="width:100%; text-align:center;" /></td>
                        <th style="text-align:left; padding:10px;">Correo:</th>
                        <td><input type="text" name="CORREO" value="" style="width:100%; text-align:center;"/></td>                            
                    </tr>  
                    <tr>
                        <th style="text-align:left; padding:10px;">Fecha Nacimiento:</th>
                        <td><input type="date" name="FECHA_NAC" value="" style="width:100%; text-align:center;" /></td>
                        <th style="text-align:left; padding:10px;">Codigo: </th>
                        <td>
                        <?php

                            // Nos conectamos y seleccionamos una base de datos.
                         $link = mysql_connect("localhost","root","");
                         mysql_select_db("BD_COLEGIOPRIMARIA2",$link);
                         // Con estas lineas haremos un a consulta a la base de datos para saber cual es la cantidad de trabajadores que hay.
                         $result = mysql_query("SELECT COUNT(*) AS CUENTA FROM PERSONAS");
                         $row=mysql_fetch_array($result);
                         $resultado= $row['CUENTA'];
                         $total = $resultado + 1;

                        echo    '<input type="number" name="COD_PERSONA" readonly=”readonly” value="'.$total.'" style="width:100%; background-color: #FFFECF; text-align:center;" />';
                        ?>

                        </td>
                        <th style="text-align:left; padding:10px;"><label>Cargo:</label></th>
                        <td>
                            <select name="CARGO" style=" width:100%; text-align:center;">
                                <option style="text-align:center;">------</option>
                                <option style="text-align:center;" value="Matricula">Matricula </option>
                                <option style="text-align:center;" value="Docente por horas">Docente por horas</option>
                            </select>
                        </td>
                    </tr>
                    <tr>    
                        <th style="text-align:left; padding:10px;">Funcion:</th>
                        <td><input type="text" name="FUNCION" value="" style="width:100%; text-align:center;" /></td>                            
                        <th style="text-align:left; padding:10px;"><label>Estado:</label> </th>
                        <td>
                            <input type="radio" name="ESTADO" value="1" checked="true" /> Activo
                            <input type="radio" name="ESTADO" value="0" required="" /> Inactivo
                        </td>     
                        <th style="text-align:left; padding:10px;">Nivel Instruccion:</th>
                        <td><input type="text" name="NIVEL_INSTRUCCION" value="" style="width:100%; text-align:center;" /></td>                   
                    </tr>
         			<tr>
                        <th style="text-align:left; padding:10px;">Carrera Profesional:</th>
                        <td><input type="text" name="CARRERA_PROFESIONAL" value="" style="width:100%; text-align:center;" /></td>                            
                        <th style="text-align:left; padding:10px;">Fecha Inicio:</th>
                        <td><input type="date" name="FECHA_INICIO" value="" style="width:100%; text-align:center;" /></td>
                        <th style="text-align:left; padding:10px; ">Fecha Fin</th>
                        <td><input type="date" name="FECHA_FIN" value="" style="width:100%; text-align:center;" /></td>                        
                    </tr>
                </table>
            </form>
        </div>
    </div>


<!--MUESTRA EL TOTAL DE LOS REGISTROS-->
<?php

// Nos conectamos y seleccionamos una base de datos.
$link = mysql_connect("localhost","root","");
        mysql_select_db("BD_COLEGIOPRIMARIA2",$link);
// Con estas lineas haremos un a consulta a la base de datos para saber cual es la cantidad de trabajadores que hay.
       $result = mysql_query("SELECT COUNT(*) AS CUENTA FROM PERSONAS");
       $row=mysql_fetch_array($result);
       $resultado= $row['CUENTA'];

       echo   "Total Registro de Docentes: ". '<input type="number" align="left" name="COD_PERSONA" disabled="disabled" value="'.$resultado.'" style="background-color: #F1F2F5; text-align:center;" />';
?>


<!--MUESTRA LOS REGISTRO DEL DOCENTE DE FORMA GENERAL-->
<?php			
	$resultado = array();//VARIABLE TIPO RESULTADO
					//$doc->__SET('Cod_Persona',          $_POST['Cod_Persona']);//ESTABLECEMOS EL VALOR DEL DNI
					//$doc->__SET('Cod_Persona',          $_POST['Cod_Persona']);//ESTABLECEMOS EL VALOR DEL DNI
					//$resultado = $perDAO->Listar_per($per); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
	$resultado = $docDAO->Listar_doc($doc);
    if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
	{//Inicio del if
?>
	<table style="width: 100%; background-color: #3374FF; border-collapse: separate;" class="pure-table pure-table-horizontal">

    <h4 style="color: black; text-align:center;">.:REGISTRO DOCENTES:.</h4>

		<thead>
			<tr>   <!--ESTA MUESTRA LOS CAMPOS EN UNA TABLA-->
				<th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>COD.</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>A. PATERNO</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>A. MATERNO</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>NOMBRES</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>DNI</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>CARGO</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>FUNCION</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>ESTADO</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>N. INSTRUCCION</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>CARRERA PRO.</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>F. INICIO</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>F. FIN</th></FONT>
			</tr>
		</thead>
	<?php foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
	?>
		<tr>
			<td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.COD_PERSONA'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('PER.APE_PATERNO'); ?></td></FONT> 
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('PER.APE_MATERNO'); ?></td></FONT>
		    <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('PER.NOMBRES'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('PER.DNI'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.CARGO'); ?></td> </FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.FUNCION'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.ESTADO'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.NIVEL_INSTRUCCION'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.CARRERA_PROFESIONAL'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.FECHA_INICIO'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.FECHA_FIN'); ?></td></FONT>                 
		</tr>



	<?php endforeach;
	} //fin del if
	else{
    	echo '<br></br>!NO SE ENCUETRA REGISTRADO EN LA BASE DE DATOS!';
	}
    ?>



 <!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->

                <?php
                if(isset($_POST['buscar']))
                {
                    $resultado = array();//VARIABLE TIPO RESULTADO
                    $per->__SET('DNI',          $_POST['DNI']);//ESTABLECEMOS EL VALOR DEL DNI
                    $resultado = $perDAO->Buscar_per($per); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
                    if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
                    {
                        ?>
                        <table class="pure-table pure-table-horizontal">
    <h4 style="color: black; text-align:center;">.:DOCENTE:.</h4>
                                <thead>
                                        <tr>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>COD.</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>DNI</th></FONT>                
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>A. PATERNO</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>A. MATERNO</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>NOMBRES</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>CARGO</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>FUNCION</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>ESTADO</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>N. INSTRUCCION</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>CARRERA PRO.</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>F. INICIO</th></FONT>
                <th style="text-align:center; background-color: #3374FF; color: white;"><FONT SIZE=1>F. FIN</th></FONT>
                                        </tr>
                                </thead>
                        <?php
                        foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
                            ?>
                                <tr>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.COD_PERSONA'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('PER.DNI'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('PER.APE_PATERNO'); ?></td></FONT> 
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('PER.APE_MATERNO'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('PER.NOMBRES'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.CARGO'); ?></td> </FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.FUNCION'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.ESTADO'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.NIVEL_INSTRUCCION'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.CARRERA_PROFESIONAL'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.FECHA_INICIO'); ?></td></FONT>
            <td style="text-align:center; background-color: #F1F2F5;"><FONT SIZE=2>
                <?php echo $r->__GET('DOC.FECHA_FIN'); ?></td></FONT>                 
                                </tr>
                        <?php endforeach;
                    }
                    else
                    {
                        echo '!NO SE ENCUETRA REGISTRADO EN LA BASE DE DATOS!';
                    }
                    ?>
                    </table>
                    <?php
                }
                ?>
    </body>
</html>
