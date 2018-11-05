use bd_colegioprimaria;


#Procedimiento para registrar secciones

DELIMITER $$
CREATE PROCEDURE Proc_insertar_secciones
(
	IN _Descripcion			varchar(30),
    IN _Cod_Persona			int(11),
    IN _Cod_Turnos			int(11),
    IN _Cod_Fase			int(11),
    IN _Aforo				int(11),
    IN _RD_institucional	varchar(30),
    IN _Fecha_Aprobacion	date,
    IN _n_estudiantes		int(11),
    IN _Cod_grados			int(11)
)
begin
	INSERT INTO SECCIONES 
    (DESCRIPCION, COD_PERSONA, COD_TURNOS, COD_FASE, AFORO, RD_INSTITUCIONAL, FECHA_APROBACION, N_ESTUDIANTES, COD_GRADOS)
	VALUES (_Descripcion,_Cod_Persona,_Cod_Turnos,_Cod_Fase,_Aforo,_RD_institucional,_Fecha_Aprobacion,_n_estudiantes,_Cod_grados);
end
$$


#Procedimiento para buscar secciones

DELIMITER $$
CREATE PROCEDURE Proc_buscar_secciones
(
	in _Cod_grados	int(11)
)
begin
SELECT SEC.COD_SECCIONES, SEC.DESCRIPCION, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO, ', ', P.NOMBRES) AS TUTOR_DOCENTE,
	   TU.DESCRIPCION AS TURNO, TF.DESCRIPCION AS FASE, SEC.AFORO AS MAX_ESTUDIANTES, SEC.RD_INSTITUCIONAL, SEC.FECHA_APROBACION, SEC.N_ESTUDIANTES, 
	   G.DESCRIPCION AS GRADO FROM SECCIONES SEC
INNER JOIN DOCENTES DOC ON SEC.COD_PERSONA = DOC.COD_PERSONA
INNER JOIN PERSONAS P ON SEC.COD_PERSONA = P.COD_PERSONA
INNER JOIN TURNOS TU ON SEC.COD_TURNOS = TU.COD_TURNOS
INNER JOIN FASES_ESCOLARES FE ON SEC.COD_FASE = FE.COD_FASE
INNER JOIN TIPO_FASE TF ON FE.COD_TIPOFASE = TF.COD_TIPOFASE 
INNER JOIN GRADOS G ON SEC.COD_GRADOS = G.COD_GRADOS
Where SEC.COD_GRADOS = _Cod_grados;
end
$$

call Proc_buscar_secciones(13);