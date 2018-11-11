#UTILIZAMOS LA BASE DE DATOS
USE BD_COLEGIOPRIMARIA;

delimiter $$
create procedure proc_registrar_matricula
(
	IN _Cod_Persona			int(11),
    IN _Fecha_Matricula		date,
    IN _Repetir_grado		varchar(10),
    IN _Condicion_matricula	varchar(20),
	IN _Situacion_matricula	varchar(30),
    IN _Tipo_procedencia	varchar(30),
    IN _Observaciones		varchar(80),
    IN _Cod_Estudiante		char(14),
    IN _Estado_Matricula	varchar(20),
    IN _Descripcion_IE		varchar(50),
    IN _Cod_Secciones		int(11),
    IN _Cod_Grados			int(11)
)
begin
	INSERT INTO MATRICULAS
            (COD_PERSONA, FECHA_MATRICULA, REPETIR_GRADO, CONDICION_MATRICULA, SITUACION_MATRICULA, 
            TIPO_PROCEDENCIA, OBSERVACIONES, COD_ESTUDIANTE, ESTADO_MATRICULA, DESCRIPCION_IE, COD_SECCIONES,
            COD_GRADOS) 
	VALUES (_Cod_Persona,_Fecha_Matricula, _Repetir_grado, _Condicion_matricula, _Situacion_matricula, _Tipo_procedencia, _Observaciones,
            _Cod_Estudiante, _Estado_Matricula,_Descripcion_IE, _Cod_Secciones,_Cod_Grados);
end
$$

delimiter $$
create procedure proc_buscar_matricula
(
	in _cod_estudiante varchar(14)
)
begin
	SELECT MAT.COD_MATRICULA, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO, ', ', P.NOMBRES) AS ESTUDIANTE,
	   MAT.FECHA_MATRICULA, MAT.REPETIR_GRADO, MAT.CONDICION_MATRICULA, MAT.SITUACION_MATRICULA, 
       MAT.TIPO_PROCEDENCIA, MAT.OBSERVACIONES, EST.COD_ESTUDIANTE, MAT.ESTADO_MATRICULA, MAT.DESCRIPCION_IE, 
       SEC.DESCRIPCION AS SECCION, G.DESCRIPCION AS GRADO
    FROM MATRICULAS MAT
	INNER JOIN PERSONAS P ON MAT.COD_PERSONA = P.COD_PERSONA
	INNER JOIN ESTUDIANTES EST ON MAT.COD_ESTUDIANTE = EST.COD_ESTUDIANTE
	INNER JOIN SECCIONES SEC ON MAT.COD_SECCIONES = SEC.COD_SECCIONES
	INNER JOIN GRADOS G ON MAT.COD_GRADOS = G.COD_GRADOS
	where  MAT.COD_ESTUDIANTE = _cod_estudiante;
end
$$

select * from estudiantes;
Call proc_buscar_matricula('15487815457847');