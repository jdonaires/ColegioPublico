#UTILIZAMOS LA BASE DE DATOS
USE BD_COLEGIOPRIMARIA;

# PROCEDIMIENTO ALMACENADO PARA REGISTRAR PERSONAS
delimiter $$
Create procedure proc_registrar_personas
(
	in _Ape_Paterno 	varchar(80), 
    in _Ape_Materno 	varchar(80),
    in _Nombres			varchar(80),
    in _Sexo			char(1),
    in _Estado_Civil	varchar(15),
    in _Fecha_Nac		date,
    in _Direccion	    varchar(80),
    in _Telefono		int(9),
    in _Correo			varchar(50),
    in _Cod_distrito	char(18)
)
begin 
	INSERT INTO PERSONAS (APE_PATERNO, APE_MATERNO, NOMBRES, SEXO, ESTADO_CIVIL, FECHA_NAC, DIRECCION, TELEFONO, CORREO, COD_DISTRITO) 
    VALUES (_Ape_Paterno, _Ape_Materno, _Nombres, _Sexo, _Estado_Civil, _Fecha_Nac, _Direccion ,_Telefono ,_Correo,_Cod_distrito); 

end
$$

# call proc_registrar_personas ('CASTRO', 'PALOMINO', 'LUCERO', 'F', 'SOLTERO', '1993-10-06', 'AV. MIRAFLORES #150' ,'345571','LUCERO@GMAIL.COM', 'D009707');



# FUNCION QUE NOS RETORNA EL ULTIMO REGISTRO INSERTADO DE LA TABLA PERSONAS
DELIMITER $$
CREATE FUNCTION personas() RETURNS int
BEGIN
  DECLARE salida  int DEFAULT 0;
  SET salida = (SELECT MAX(cod_persona) AS id FROM personas);
  RETURN salida;
END
$$

# select * from tipo_documento;
# select * from tipo_documento_personas;

# PROCEDIMIENTO ALMACENADO PARA REGISTRAR TIPO DOCUMENTO Y PERSONAS
DELIMITER $$
CREATE PROCEDURE proc_registrar_TDocumento_Personas
(
	IN _Cod_Documento		int(11),
    IN _Numero_Identidad	varchar(15)
)
BEGIN 
	DECLARE _personas int(11) DEFAULT 0;
    SET _personas = (select personas());
    INSERT INTO TIPO_DOCUMENTO_PERSONAS (COD_DOCUMENTO, COD_PERSONA, NUMERO_IDENTIDAD) 
    VALUES (_Cod_Documento,_personas,_Numero_Identidad);
END
$$

# Call proc_registrar_TDocumento_Personas(1,'48457484');



# PROCEDIMIENTO ALMACENADO PARA REGISTRAR DOCENTES
delimiter $$
Create procedure proc_registrar_docentes
(
    in _Cargo		 		varchar(50),
    in _Funcion				varchar(50),
    in _Estado				char(1),
    in _Nivel_Instruccion	varchar(50),
    in _Carrera_Profesional varchar(50),
    in _Fecha_inicio	    date,
    in _Fecha_Fin			date

)
begin 
	DECLARE _personas int(11) DEFAULT 0;
    SET _personas = (select personas());
    INSERT INTO DOCENTES (COD_PERSONA, CARGO, FUNCION, ESTADO, NIVEL_INSTRUCCION, CARRERA_PROFESIONAL, FECHA_INICIO, FECHA_FIN) 
    VALUES (_personas,_Cargo,_Funcion,_Estado,_Nivel_Instruccion,_Carrera_Profesional,_Fecha_inicio,_Fecha_Fin);
    end
$$

# call proc_registrar_docentes('DOCENTE POR HORAS','RESPONSABLE DE MATRICULA','1','EDUCACION UNIVERSITARIA','PSICOLOGIA','2017-03-01','2017-12-30');

# PROCEDIMIENTO ALMACENADO PARAREGISTRAR DOCENTES
DELIMITER $$
CREATE PROCEDURE proc_listar_docentes
(
)
begin
	SELECT P.COD_PERSONA, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO, ', ', P.NOMBRES) AS DATOS, 
    TD.DESCRIPCION AS TIPO_DOCUMENTO, TP.NUMERO_IDENTIDAD, DOC.CARGO, DOC.FUNCION, DOC.NIVEL_INSTRUCCION,
    DOC.CARRERA_PROFESIONAL, DOC.FECHA_INICIO, DOC.FECHA_FIN 
    FROM DOCENTES DOC
	INNER JOIN PERSONAS P ON DOC.COD_PERSONA = P.COD_PERSONA
    INNER JOIN TIPO_DOCUMENTO_PERSONAS TP ON P.COD_PERSONA = TP.COD_PERSONA
    INNER JOIN TIPO_DOCUMENTO TD ON TP.COD_DOCUMENTO = TD.COD_DOCUMENTO
    ORDER BY P.COD_PERSONA ASC;
end
$$

# CALL proc_listar_docentes();


DELIMITER $$
CREATE PROCEDURE proc_buscar_docentes
(
	in _tipodoc	int(11),
    in _numdoc	varchar(15)
)
begin 
	SELECT P.COD_PERSONA, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO, ', ', P.NOMBRES) AS DATOS, 
    TD.DESCRIPCION AS TIPO_DOCUMENTO, TP.NUMERO_IDENTIDAD, DOC.CARGO, DOC.FUNCION, DOC.NIVEL_INSTRUCCION,
    DOC.CARRERA_PROFESIONAL, DOC.FECHA_INICIO, DOC.FECHA_FIN 
    FROM DOCENTES DOC
	INNER JOIN PERSONAS P ON DOC.COD_PERSONA = P.COD_PERSONA
    INNER JOIN TIPO_DOCUMENTO_PERSONAS TP ON P.COD_PERSONA = TP.COD_PERSONA
    INNER JOIN TIPO_DOCUMENTO TD ON TP.COD_DOCUMENTO = TD.COD_DOCUMENTO
    WHERE TP.COD_DOCUMENTO = _tipodoc and TP.NUMERO_IDENTIDAD=_numdoc
    ORDER BY P.COD_PERSONA ASC;
end
$$

CALL proc_buscar_docentes(1,'48457484');

# select * from personas;
# select * from docentes;

# PROCEDIMIENTO ALMACENADO PARA REGISTRAR ESTUDIANTES

DELIMITER $$
CREATE PROCEDURE proc_registrar_estudiantes
(
	in _N_Hermanos			int(11),
    in _Lugar_Ocupa			int(11),
    in _Religion			varchar(50),
    in _saanee				char(2),
    in _Frecuencia_saanee	varchar(15),
    in _Cod_Discapacidad	int(11),
    in _Cod_Estudiante		char(14)
)
begin 
	DECLARE _personas int(11) DEFAULT 0;
    SET _personas = (select personas());
	INSERT INTO ESTUDIANTES (COD_PERSONA, N_HERMANOS, LUGAR_OCUPA, RELIGION, SAANEE, FRECUENCIA_SAANEE, COD_DISCAPACIDAD, COD_ESTUDIANTE)
    VALUES (_personas,_N_Hermanos,_Lugar_Ocupa,_Religion,_saanee,_Frecuencia_saanee,_Cod_Discapacidad,_Cod_Estudiante);
end
$$

DELIMITER $$
CREATE PROCEDURE proc_listar_estudiantes
(
)
begin 
	SELECT P.COD_PERSONA, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO, ', ', P.NOMBRES) AS DATOS, 
    TD.DESCRIPCION AS TIPO_DOCUMENTO, TP.NUMERO_IDENTIDAD, EST.N_HERMANOS, EST.LUGAR_OCUPA, EST.RELIGION,
    EST.SAANEE, EST.FRECUENCIA_SAANEE, DIS.DESCRIPCION, EST.COD_ESTUDIANTE 
    FROM ESTUDIANTES EST
	INNER JOIN PERSONAS P ON EST.COD_PERSONA= P.COD_PERSONA
    INNER JOIN TIPO_DOCUMENTO_PERSONAS TP ON P.COD_PERSONA = TP.COD_PERSONA
    INNER JOIN TIPO_DOCUMENTO TD ON TP.COD_DOCUMENTO = TD.COD_DOCUMENTO
	INNER JOIN DISCAPACIDADES DIS ON EST.COD_DISCAPACIDAD = DIS.COD_DISCAPACIDAD;
end
$$

call proc_listar_estudiantes();

DELIMITER $$
CREATE PROCEDURE proc_buscar_estudiantes
(
	in _tipodoc	int(11),
    in _numdoc	varchar(15)
)
begin 
	SELECT P.COD_PERSONA, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO, ', ', P.NOMBRES) AS DATOS, 
    TD.DESCRIPCION AS TIPO_DOCUMENTO, TP.NUMERO_IDENTIDAD, EST.N_HERMANOS, EST.LUGAR_OCUPA, EST.RELIGION,
    EST.SAANEE, EST.FRECUENCIA_SAANEE, DIS.DESCRIPCION, EST.COD_ESTUDIANTE 
    FROM ESTUDIANTES EST
	INNER JOIN PERSONAS P ON EST.COD_PERSONA= P.COD_PERSONA
    INNER JOIN TIPO_DOCUMENTO_PERSONAS TP ON P.COD_PERSONA = TP.COD_PERSONA
    INNER JOIN TIPO_DOCUMENTO TD ON TP.COD_DOCUMENTO = TD.COD_DOCUMENTO
	INNER JOIN DISCAPACIDADES DIS ON EST.COD_DISCAPACIDAD = DIS.COD_DISCAPACIDAD
    WHERE TP.COD_DOCUMENTO = _tipodoc and TP.NUMERO_IDENTIDAD=_numdoc
    ORDER BY P.COD_PERSONA ASC;
end
$$

call proc_buscar_estudiantes(1,'70337847');
#call proc_buscar_estudiantes(3,'454748545448');
