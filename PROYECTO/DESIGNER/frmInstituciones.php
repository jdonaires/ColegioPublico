<?php
require_once('../BOL/instituciones.php');
require_once('../DAO/institucionesDAO.php');
require_once('../DAO/tipos_ieDAO.php');

$ints = new Instituciones();
$instDAO = new InstitucionesDAO();

$tip = new Tipos_IEDAO();
$data=$tip->cargarCombo(); 
$dis=$tip->cargarDistritos();

if(isset($_POST['guardar']))
{
    
   //$datos = base64_encode(file_get_contents($_FILES['insignia']['tmp_name']));

        $image = $_FILES['insignia']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));


	//$ints->__SET('cod_institucion',         $_POST['cod_institucion']);
	$ints->__SET('cod_modular',          	$_POST['cod_modular']);
	$ints->__SET('anexo',        			$_POST['anexo']);
	$ints->__SET('nivel', 					$_POST['nivel']);
	$ints->__SET('nombre',           		$_POST['nombre']);
	$ints->__SET('gestion',          		$_POST['gestion']);
	$ints->__SET('forma',        			$_POST['forma']);
	$ints->__SET('codigo_local', 			$_POST['codigo_local']);
	$ints->__SET('dre',           			$_POST['dre']);
	$ints->__SET('ugel',          			$_POST['ugel']);
	$ints->__SET('resolucion',        		$_POST['resolucion']);
	$ints->__SET('emblematica', 			$_POST['emblematica']);
	$ints->__SET('direccion',           	$_POST['direccion']);
	$ints->__SET('centro_poblado',          $_POST['centro_poblado']);
	$ints->__SET('resolucion_ie',        	$_POST['resolucion_ie']);
	$ints->__SET('telefono',        		$_POST['telefono']);
	$ints->__SET('pagina_web', 				$_POST['pagina_web']);
	$ints->__SET('genero',           		$_POST['genero']);
	$ints->__SET('correo',          		$_POST['correo']);
	$ints->__SET('cod_tipoie',        		$_POST['tipos_colegios']);
	$ints->__SET('cod_distrito', 			$_POST['distrito']);
	$ints->__SET('insignia',           		 $imgContenido);//$_POST['insignia']);

	$instDAO->Registrar($ints);
	header('Location: frmInstituciones.php');

}

if(isset($_REQUEST['action']))
{
    switch($_REQUEST['action'])
    {
        case 'eliminar':
            $instDAO->Eliminar($_REQUEST['id']);
            header('Location: frmInstituciones.php');
            break;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
         <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <!--<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" ">-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">

                    <table style="width:500px;" border="0">
                    	<!-- esto es un comentario en Html
						Con respecto a estas lineas se ha implementado para ingresar el codi
						go del curso
                    	-->

                        <!--
                    	<tr>
                            <th style="text-align:left;">Codigo:</th>
                            <td><input type="text" name="cod_institucion" value="" style="width:100%;" required/></td>
                        </tr>
                        -->
                        
                        <tr>
                            <th style="text-align:left;">Codigo Modular:</th>
                            <td><input type="text" name="cod_modular" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Anexo:</th>
                            <td><input type="text" name="anexo" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nivel:</th>
                            <!--
                            <td><input type="text" name="nivel" value="" style="width:100%;" required /></td> -->
                            <td> 
                            	<select name="nivel" style="width:100%;">
							  		<option value="Inicial">Inicial</option>
							  		<option value="Primaria">Primaria</option>
							  		<option value="Secundaria">Secundaria</option>
								</select> 
							</td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nombre Institucion:</th>
                            <td><input type="text" name="nombre" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Gestion:</th>
                            <td><input type="text" name="gestion" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Forma:</th>
                            <td><input type="text" name="forma" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Codigo Local:</th>
                            <td><input type="text" name="codigo_local" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">DRE:</th>
                            <td><input type="text" name="dre" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">UGEL:</th>
                            <td><input type="text" name="ugel" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Resolucion:</th>
                            <td><input type="text" name="resolucion" value="" style="width:100%;"  /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Emblematica:</th>
                            <!-- <td><input type="text" name="emblematica" value="" style="width:100%;" required /></td> -->

                            <td><input type="radio" name="emblematica" value="Si"> Si
  								<input type="radio" name="emblematica" value="No"> No
  							</td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Direccion:</th>
                            <td><input type="text" name="direccion" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Centro Poblado:</th>
                            <td><input type="text" name="centro_poblado" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Resolucion Institucional:</th>
                            <td><input type="text" name="resolucion_ie" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Telefono:</th>
                            <td><input type="text" name="telefono" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Pagina Web:</th>
                            <td><input type="text" name="pagina_web" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Genero:</th>
                            <!-- <td><input type="text" name="genero" value="" style="width:100%;" required /></td> -->
                            <td> 
                            	<select name="genero" style="width:100%;">
							  		<option value="Solo Varones">Solo Varones</option>
							  		<option value="Solo Mujeres">Solo Mujeres</option>
							  		<option value="Mixto">Mixto</option>
								</select> 
							</td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Correo:</th>
                            <td><input type="text" name="correo" value="" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Tipo de I.E:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="tipos_colegios" style="width:100%;">
											<?php foreach ($data as $row){
												echo 
													'<option value="'.$row['cod_tipoie'].'">'.$row['descripcion'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>
                        <!--
                        <tr>
                            <th style="text-align:left;">Distrito:</th>
                            <td><input type="text" name="cod_distrito" value="" style="width:100%;" required /></td>
                        </tr>
                        -->
                        <tr>
                            <th style="text-align:left;">Distrito:</th>
                            <td>
                                <select name="distrito" style="width:100%;">
                                            <?php foreach ($dis as $row){
                                                echo 
                                                    '<option value="'.$row['cod_distrito'].'">'.$row['descripcion'].'</option>';
                                            } ?>
                                </select>
                                
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Insignia:</th>
                            <!--<td><input type="text" name="insignia" accept="image/*" value="" style="width:100%;" required /></td>-->
                            <td><input type="file" name="insignia" accept="image/png" style="width:100%;"></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">

                                <input type="submit" value="LISTAR" name="listar"class="pure-button pure-button-primary">

                                <input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
                            </td>
                          
                        </tr>
                    </table>
                </form>
            </div>
        </div>

                <?php
                if(isset($_POST['listar']))
                {
                    $listado=$instDAO->get_instituciones();
                ?>
                    <table class="pure-table pure-table-horizontal">
                        <thead>
                            <tr>
                                <th style="text-align:left;">ID</th>
                                <th style="text-align:left;">Cod Modular</th>
                                <th style="text-align:left;">Anexo</th>
                                <th style="text-align:left;">Nivel</th>
                                <th style="text-align:left;">Nombre Institucion</th>
                                <th style="text-align:left;">Gestion</th>
                                <th style="text-align:left;">Forma Modular</th>
                                <th style="text-align:left;">Cod. Local</th>
                                <th style="text-align:left;">DRE</th>
                                <th style="text-align:left;">UGEL</th>
                                <th style="text-align:left;">Resolucion</th>
                                <th style="text-align:left;">Emblematica</th>
                                <th style="text-align:left;">Direccion</th>
                                <th style="text-align:left;">Centro Poblado</th>
                                <th style="text-align:left;">Resolucion Institucional</th>
                                <th style="text-align:left;">Telefono</th>
                                <th style="text-align:left;">Pagina Web</th>
                                <th style="text-align:left;">Genero</th>
                                <th style="text-align:left;">Correo</th>
                                <th style="text-align:left;">Tipo I.E</th>
                                <th style="text-align:left;">Distrito</th>
                                <th style="text-align:left;">Insignia</th>
                                <th style="text-align:left;">Editar</th>
                                <th style="text-align:left;">Eliminar</th>
                            </tr>
                        </thead>

                        <?php
                            foreach($listado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
                        ?>
                                <tr>
                                    <td><?php echo $r['COD_INSTITUCION']; ?></td>
                                    <td><?php echo $r['COD_MODULAR']; ?></td>
                                    <td><?php echo $r['ANEXO']; ?></td>
                                    <td><?php echo $r['NIVEL']; ?></td>
                                    <td><?php echo $r['NOMBRE']; ?></td>
                                    <td><?php echo $r['GESTION']; ?></td>
                                    <td><?php echo $r['FORMA']; ?></td>
                                    <td><?php echo $r['CODIGO_LOCAL']; ?></td>
                                    <td><?php echo $r['DRE']; ?></td>
                                    <td><?php echo $r['UGEL']; ?></td>
                                    <td><?php echo $r['RESOLUCION']; ?></td>
                                    <td><?php echo $r['EMBLEMATICA']; ?></td>
                                    <td><?php echo $r['DIRECCION']; ?></td>
                                    <td><?php echo $r['CENTRO_POBLADO']; ?></td>
                                    <td><?php echo $r['RESOLUCION_IE']; ?></td>
                                    <td><?php echo $r['TELEFONO']; ?></td>
                                    <td><?php echo $r['PAGINA_WEB']; ?></td>
                                    <td><?php echo $r['GENERO']; ?></td>
                                    <td><?php echo $r['CORREO']; ?></td>
                                    <td><?php echo $r['TIPO_IE']; ?></td>
                                    <td><?php echo $r['DISTRITO']; ?></td>

                                    <td><img src="data:image/png; base64 , <? echo base64_encode(stripslashes($r['INSIGNIA'])); ?>"></td>
                                       <!-- <? //echo '<td> <img src="data:image/jpg; base64 , '.base64_encode($r['INSIGNIA']).'"></td>' ?> -->


                                    <td><input type="submit" name="editar" value="Editar" id="<?=$r['COD_INSTITUCION']?>"></td>
                                    <td><a href="?action=eliminar&id=<?php echo $r['COD_INSTITUCION']; ?>">Eliminar</a></td>
                                </tr>
                        <?php endforeach;
                        ?>
                    </table>


                <?php
                }
                ?>



                <!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->

                <?php
                if(isset($_POST['buscar']))
                {
                    $resultado = array();//VARIABLE TIPO RESULTADO
                    $ints->__SET('NOMBRE',          $_POST['nombre']);//ESTABLECEMOS EL VALOR DEL DNI
                    $resultado = $instDAO->Buscar($ints); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
                    if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
                    {
                        ?>
                        <table class="pure-table pure-table-horizontal">
                                <thead>
                                        <tr>
                                            <th style="text-align:left;">ID</th>
                                            <th style="text-align:left;">Cod Modular</th>
                                            <th style="text-align:left;">Anexo</th>
                                            <th style="text-align:left;">Nivel</th>
                                            <th style="text-align:left;">Nombre Institucion</th>
                                            <th style="text-align:left;">Gestion</th>
                                            <th style="text-align:left;">Forma Modular</th>
                                            <th style="text-align:left;">Cod. Local</th>
                                            <th style="text-align:left;">DRE</th>
                                            <th style="text-align:left;">UGEL</th>
                                            <th style="text-align:left;">Resolucion</th>
                                            <th style="text-align:left;">Emblematica</th>
                                            <th style="text-align:left;">Direccion</th>
                                            <th style="text-align:left;">Centro Poblado</th>
                                            <th style="text-align:left;">Resolucion Institucional</th>
                                            <th style="text-align:left;">Telefono</th>
                                            <th style="text-align:left;">Pagina Web</th>
                                            <th style="text-align:left;">Genero</th>
                                            <th style="text-align:left;">Correo</th>
                                            <th style="text-align:left;">Tipo I.E</th>
                                            <th style="text-align:left;">Distrito</th>
                                        </tr>
                                </thead>
                        <?php
                        foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
                            ?>
                                <tr>
                                    <td><?php echo $r->__GET('COD_INSTITUCION'); ?></td>
                                    <td><?php echo $r->__GET('COD_MODULAR'); ?></td>
                                    <td><?php echo $r->__GET('ANEXO'); ?></td>
                                    <td><?php echo $r->__GET('NIVEL'); ?></td>
                                    <td><?php echo $r->__GET('NOMBRE'); ?></td>
                                    <td><?php echo $r->__GET('GESTION'); ?></td>
                                    <td><?php echo $r->__GET('FORMA'); ?></td>
                                    <td><?php echo $r->__GET('CODIGO_LOCAL'); ?></td>
                                    <td><?php echo $r->__GET('DRE'); ?></td>
                                    <td><?php echo $r->__GET('UGEL'); ?></td>
                                    <td><?php echo $r->__GET('RESOLUCION'); ?></td>
                                    <td><?php echo $r->__GET('EMBLEMATICA'); ?></td>
                                    <td><?php echo $r->__GET('DIRECCION'); ?></td>
                                    <td><?php echo $r->__GET('CENTRO_POBLADO'); ?></td>
                                    <td><?php echo $r->__GET('RESOLUCION_IE'); ?></td>
                                    <td><?php echo $r->__GET('TELEFONO'); ?></td>
                                    <td><?php echo $r->__GET('PAGINA_WEB'); ?></td>
                                    <td><?php echo $r->__GET('GENERO'); ?></td>
                                    <td><?php echo $r->__GET('CORREO'); ?></td>
                                    <td><?php echo $r->__GET('TIPO_IE'); ?></td>
                                    <td><?php echo $r->__GET('DISTRITO'); ?></td>
                                    <!--<td><?php //print base64_encode(stripslashes($r->__GET('INSIGNIA'))); ?></td>-->
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