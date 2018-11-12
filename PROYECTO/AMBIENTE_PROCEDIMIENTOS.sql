#UTILIZAMOS LA BASE DE DATOS
USE BD_COLEGIOPRIMARIA;


# PROCEDIMIENTO ALMACENADO PARA CURSOS
# PROCESO REGISTRO

DELIMITER $$
CREATE PROCEDURE Proc_registrar_ambientes
(
    IN _COD_TIPOAMBIENTE	INT(11),
    IN _DESCRIPCION 		VARCHAR(80),
    IN _UBICACION 			VARCHAR(80),
    IN _AFORO				INT(11),
    IN _AREA				INT(11),
    IN _ESTADO				VARCHAR(20),
    IN _COD_INSTITUCION		INT(11)
)
BEGIN 
	insert into ambientes (cod_tipoambiente, descripcion, ubicacion, aforo, area, estado,  cod_institucion) 
    values (_COD_TIPOAMBIENTE,_DESCRIPCION,_UBICACION,_AFORO,_AREA,_ESTADO,_COD_INSTITUCION);
END
$$

# CALL Proc_registrar_ambientes(2,'AULA GENERICA DE LA IE 3','TERCER PISO',30,52,'malo',1);


# PROCESO BUSCAR
DELIMITER $$
CREATE PROCEDURE Proc_buscar_ambientes
(
	IN _COD_TIPOAMBIENTE		INT(11)
)
begin 
	select am.Cod_ambiente, ta.Descripcion as tipo_ambiente, am.Descripcion, am.Ubicacion, am.Aforo, am.Area, am.Estado, ins.Nombre
    from ambientes am
    inner join tipo_ambientes ta on am.Cod_TipoAmbiente = ta.Cod_TipoAmbiente
    inner join instituciones ins on am.Cod_Institucion = ins.Cod_Institucion
    where am.Cod_TipoAmbiente = _COD_TIPOAMBIENTE;
end
$$

select * from ambientes;