#UTILIZAMOS LA BASE DE DATOS
USE BD_COLEGIOPRIMARIA;

DELIMITER $$
CREATE PROCEDURE Pro_insertar_tipodocumento
(
	IN _Descripcion	varchar(80)
)
begin 
	INSERT INTO TIPO_DOCUMENTO (DESCRIPCION) VALUES (_Descripcion); 
end
$$


DELIMITER $$
CREATE PROCEDURE Pro_buscar_tipodocumento
(
	IN _Descripcion	varchar(80)
)
begin 
	select Cod_Documento, Descripcion from tipo_documento where Descripcion = _Descripcion; 
end
$$

call Pro_buscar_tipodocumento('dni');