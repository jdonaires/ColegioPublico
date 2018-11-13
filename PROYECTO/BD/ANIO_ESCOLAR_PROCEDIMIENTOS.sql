USE BD_COLEGIOPRIMARIA;
alter

DELIMITER $$
CREATE PROCEDURE Proc_insertar_anioescolar
(
	IN _ANIO_ESCOLAR	INT(11), 
    IN _FECHA_INICIO	DATE, 
    IN _FECHA_FIN		DATE, 
    IN _ESTADO			VARCHAR(20), 
    IN _MODALIDAD_EVALUACION	VARCHAR(20), 
    IN _N_PERSONALIE	INT(11), 
    IN _COD_INSTITUCION	INT(11)
)
begin
	INSERT INTO ANIO_ESCOLAR (ANIO_ESCOLAR, FECHA_INICIO, FECHA_FIN, ESTADO, MODALIDAD_EVALUACION, N_PERSONALIE, COD_INSTITUCION) 
    VALUES (_ANIO_ESCOLAR,_FECHA_INICIO,_FECHA_FIN,_ESTADO,_MODALIDAD_EVALUACION,_N_PERSONALIE,_COD_INSTITUCION);  -- PARA EL ESTADO ES INACTIVO, ACTIVO, CERRADO
end
$$


DELIMITER $$
CREATE PROCEDURE Proc_buscar_anioescolar
(
	IN _ANIO_ESCOLAR	INT(11)
)
begin
	SELECT an.Cod_Escolar, an.Anio_escolar, an.Fecha_Inicio, an.Fecha_Fin, an.Estado, an.modalidad_evaluacion, an.N_personalIE, ins.Nombre
    FROM ANIO_ESCOLAR an 
    inner join instituciones ins on an.Cod_Institucion = ins.Cod_Institucion
    where an.Anio_escolar = _ANIO_ESCOLAR;
end
$$

call Proc_buscar_anioescolar(2017);