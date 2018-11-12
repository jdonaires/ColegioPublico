#UTILIZAMOS LA BASE DE DATOS
USE BD_COLEGIOPRIMARIA;

DELIMITER $$
CREATE PROCEDURE Proc_insertar_discapacidades
(
	IN _Descripcion	varchar(80)
)
begin 
	INSERT INTO DISCAPACIDADES (Descripcion) VALUES (_Descripcion);
end
$$

# CALL Proc_insertar_discapacidades('DESCONOCIDO');


DELIMITER $$
CREATE PROCEDURE Proc_buscar_discapacidades
(
	IN _Descripcion	varchar(80)
)
begin
	select Cod_Discapacidad, Descripcion from discapacidades
    where Descripcion = _Descripcion;
end
$$

call Proc_buscar_discapacidades('NINGUNA');