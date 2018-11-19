#UTILIZAMOS LA BASE DE DATOS
USE BD_COLEGIOPRIMARIA;

# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - INSTITUCIONES
# =========================================================


# PROCEDIMIENTO ALMACENADO PARA REGISTRAR INSTITUCIONES
DELIMITER $$
CREATE PROCEDURE PROC_REGISTRAR_INSTITUCIONES
(
	IN	_COD_MODULAR          INTEGER,
	IN	_ANEXO                INTEGER,
	IN	_NIVEL                VARCHAR(80),
	IN	_NOMBRE               VARCHAR(80),
	IN	_GESTION              VARCHAR(80),
	IN	_FORMA                VARCHAR(80),
	IN	_CODIGO_LOCAL         INTEGER,
	IN	_DRE                  VARCHAR(80),
	IN	_UGEL                 VARCHAR(80),
	IN	_RESOLUCION           VARCHAR(80),
	IN	_EMBLEMATICA          CHAR(2),
	IN	_DIRECCION            VARCHAR(80),
	IN	_CENTRO_POBLADO       VARCHAR(80),
	IN	_RESOLUCION_IE        VARCHAR(40),
	IN	_TELEFONO             VARCHAR(9),
	IN	_PAGINA_WEB           VARCHAR(80),
	IN	_GENERO               VARCHAR(80),
	IN	_CORREO               VARCHAR(80),
	IN	_COD_TIPOIE           INT(11),
	IN	_COD_DISTRITO         CHAR(18),
	IN	_INSIGNIA             BLOB 
)
BEGIN
INSERT INTO INSTITUCIONES(COD_MODULAR, ANEXO, NIVEL, NOMBRE, GESTION, FORMA, CODIGO_LOCAL, 
						  DRE, UGEL, RESOLUCION, EMBLEMATICA, DIRECCION, CENTRO_POBLADO, RESOLUCION_IE, 
                          TELEFONO, PAGINA_WEB, GENERO, CORREO, COD_TIPOIE, COD_DISTRITO, INSIGNIA) 
VALUES (_COD_MODULAR, _ANEXO, _NIVEL, _NOMBRE, _GESTION, _FORMA, _CODIGO_LOCAL, 
						  _DRE, _UGEL, _RESOLUCION, _EMBLEMATICA, _DIRECCION, _CENTRO_POBLADO, _RESOLUCION_IE, 
                          _TELEFONO, _PAGINA_WEB, _GENERO, _CORREO, _COD_TIPOIE, _COD_DISTRITO, _INSIGNIA);
END
$$


# PROCEDIMIENTO ALMACENADO PARA EDITAR INSTITUCIONES
DELIMITER $$
CREATE PROCEDURE PROC_MODIFICAR_INSTITUCIONES
(
	IN  _COD_INSTITUCION   	  INT(11), 
	IN	_COD_MODULAR          INT(11),
	IN	_ANEXO                INT(11),
	IN	_NIVEL                VARCHAR(80),
	IN	_NOMBRE               VARCHAR(80),
	IN	_GESTION              VARCHAR(80),
	IN	_FORMA                VARCHAR(80),
	IN	_CODIGO_LOCAL         INT(11),
	IN	_DRE                  VARCHAR(80),
	IN	_UGEL                 VARCHAR(80),
	IN	_RESOLUCION           VARCHAR(80),
	IN	_EMBLEMATICA          CHAR(2),
	IN	_DIRECCION            VARCHAR(80),
	IN	_CENTRO_POBLADO       VARCHAR(80),
	IN	_RESOLUCION_IE        VARCHAR(40),
	IN	_TELEFONO             VARCHAR(9),
	IN	_PAGINA_WEB           VARCHAR(80),
	IN	_GENERO               VARCHAR(80),
	IN	_CORREO               VARCHAR(80),
	IN	_COD_TIPOIE           INT(11),
	IN	_COD_DISTRITO         CHAR(18),
	IN	_INSIGNIA             BLOB 
)
BEGIN 
	UPDATE INSTITUCIONES SET COD_MODULAR = _COD_MODULAR,
							 ANEXO = _ANEXO,
                             NIVEL = _NIVEL,
                             NOMBRE = _NOMBRE,
                             GESTION = _GESTION,
                             FORMA = _FORMA,
                             CODIGO_LOCAL = _CODIGO_LOCAL,
                             DRE = _DRE,
                             UGEL = _UGEL,
                             RESOLUCION = _RESOLUCION,
                             EMBLEMATICA = _EMBLEMATICA,
                             DIRECCION = _DIRECCION,
                             CENTRO_POBLADO = _CENTRO_POBLADO,
                             RESOLUCION_IE = _RESOLUCION_IE,
                             TELEFONO = _TELEFONO,
                             PAGINA_WEB = _PAGINA_WEB,
                             GENERO = _GENERO,
                             CORREO = _CORREO,
                             COD_TIPOIE = _COD_TIPOIE,
                             COD_DISTRITO = _COD_DISTRITO,
                             INSIGNIA = _INSIGNIA
	WHERE COD_INSTITUCION = _COD_INSTITUCION;
END
$$

# PROCEDIMIENTO ALMACENADO PARA ELIMINAR INSTITUCIONES
DELIMITER $$
CREATE PROCEDURE PROC_ELIMINAR_INSTITUCIONES
(
	IN _COD_INSTITUCION   	  INT(11)
)
BEGIN 
	DELETE FROM INSTITUCIONES WHERE COD_INSTITUCION = _COD_INSTITUCION;
END
$$

# PROCEDIMIENTO ALMACENADO PARA LISTAR INSTITUCIONES
DELIMITER $$
CREATE PROCEDURE PROC_LISTAR_INSTITUCIONES
(
)
BEGIN
	SELECT INS.COD_INSTITUCION, INS.COD_MODULAR, INS.ANEXO, INS.NIVEL, INS.NOMBRE, INS.GESTION, INS.FORMA, INS.CODIGO_LOCAL, 
		   INS.DRE, INS.UGEL, INS.RESOLUCION, INS.EMBLEMATICA, INS.DIRECCION, INS.CENTRO_POBLADO, INS.RESOLUCION_IE, 
		   INS.TELEFONO, INS.PAGINA_WEB, INS.GENERO, INS.CORREO, TIP.DESCRIPCION AS TIPO_IE, DIS.DESCRIPCION AS DISTRITO, INS.INSIGNIA 
	FROM INSTITUCIONES INS
	INNER JOIN TIPO_INSTITUCIONES TIP ON INS.COD_TIPOIE = TIP.COD_TIPOIE
	INNER JOIN DISTRITOS DIS ON INS.COD_DISTRITO = DIS.COD_DISTRITO
    ORDER BY INS.COD_INSTITUCION ASC;
END
$$

# PROCEDIMIENTO ALMACENADO PARA FILTRAR INSTITUCIONES
DELIMITER $$
CREATE PROCEDURE PROC_FILTRAR_INSTITUCIONES
(
    IN _NOMBRES		VARCHAR(80)
)
BEGIN 
	 SELECT INS.COD_INSTITUCION, INS.COD_MODULAR, INS.ANEXO, INS.NIVEL, INS.NOMBRE, INS.GESTION, INS.FORMA, INS.CODIGO_LOCAL, 
		   INS.DRE, INS.UGEL, INS.RESOLUCION, INS.EMBLEMATICA, INS.DIRECCION, INS.CENTRO_POBLADO, INS.RESOLUCION_IE, 
		   INS.TELEFONO, INS.PAGINA_WEB, INS.GENERO, INS.CORREO, TIP.COD_TIPOIE,TIP.DESCRIPCION AS TIPO_IE, DIS.DESCRIPCION AS DISTRITO, INS.INSIGNIA 
	FROM INSTITUCIONES INS
	INNER JOIN TIPO_INSTITUCIONES TIP ON INS.COD_TIPOIE = TIP.COD_TIPOIE
	INNER JOIN DISTRITOS DIS ON INS.COD_DISTRITO = DIS.COD_DISTRITO
     WHERE (INS.NOMBRE Like CONCAT(_NOMBRES,'%'));
END
$$

CALL PROC_FILTRAR_INSTITUCIONES('');


# PROCEDIMIENTO ALMACENADO PARA FILTRAR INSTITUCIONES
DELIMITER $$
CREATE PROCEDURE PROC_BUSCAR_INSTITUCIONES
(
    IN _COD_INSTITUCION		INT(11)
)
BEGIN 
	 SELECT INS.COD_INSTITUCION, INS.COD_MODULAR, INS.ANEXO, INS.NIVEL, INS.NOMBRE, INS.GESTION, INS.FORMA, INS.CODIGO_LOCAL, 
		   INS.DRE, INS.UGEL, INS.RESOLUCION, INS.EMBLEMATICA, INS.DIRECCION, INS.CENTRO_POBLADO, INS.RESOLUCION_IE, 
		   INS.TELEFONO, INS.PAGINA_WEB, INS.GENERO, INS.CORREO, TIP.COD_TIPOIE, TIP.DESCRIPCION AS TIPO_IE, DIS.DESCRIPCION AS DISTRITO, INS.INSIGNIA 
	FROM INSTITUCIONES INS
	INNER JOIN TIPO_INSTITUCIONES TIP ON INS.COD_TIPOIE = TIP.COD_TIPOIE
	INNER JOIN DISTRITOS DIS ON INS.COD_DISTRITO = DIS.COD_DISTRITO
     WHERE INS.COD_INSTITUCION = _COD_INSTITUCION;
END
$$

CALL PROC_BUSCAR_INSTITUCIONES(1);





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - AMBIENTES
# =========================================================

# PROCEDIMIENTO ALMACENADO PARA RESGISTRAR AMBIENTES
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





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - TIPOS AMBIENTES
# =========================================================

# PROCEDIMIENTO REGISTRAR
DELIMITER $$
CREATE PROCEDURE PROC_INSERTAR_TIPOSAMBIENTES
(
	IN _DESCRIPCION VARCHAR(80)
)
BEGIN
	INSERT INTO TIPO_AMBIENTES (DESCRIPCION, ESTADO) VALUES (_DESCRIPCION,'1');
END
$$

# PROCEDIMIENTO BUSCAR
DELIMITER $$
CREATE PROCEDURE PROC_BUSCAR_TIPOSAMBIENTES
(
	IN _DESCRIPCION VARCHAR(80)
)
BEGIN 
	SELECT COD_TIPOAMBIENTE, DESCRIPCION FROM TIPO_AMBIENTES
    WHERE  DESCRIPCION = _DESCRIPCION 
	AND  ESTADO = '1';
END
$$

CALL PROC_BUSCAR_TIPOSAMBIENTES('cocina');

# PROCEDIMIENTO LISTAR
DELIMITER $$
CREATE PROCEDURE PROC_LISTAR_TIPOSAMBIENTES
(
)
begin 
	SELECT COD_TIPOAMBIENTE, DESCRIPCION, ESTADO from TIPO_AMBIENTES
    where ESTADO='1';
end
$$

CALL PROC_LISTAR_TIPOSAMBIENTES();





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - AÑO ESCOLAR
# =========================================================

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





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - COMPETENCIAS
# =========================================================

# PROCESO REGISTRO
DELIMITER $$
CREATE PROCEDURE Proc_registrar_competencias
(
    IN _DESCRIPCION		VARCHAR(80),
    IN _JUSTIFICACION	VARCHAR(80),
    IN _COD_CURSOS		INT(11)
)
BEGIN 
	insert into capacidades (descripcion, justificacion, cod_cursos) values (_DESCRIPCION, _JUSTIFICACION, _COD_CURSOS);
END
$$

# PROCESO MODIFICAR
DELIMITER $$
CREATE PROCEDURE Proc_modificar_competencias
(
	IN _COD_CAPACIDADES		INT(11),
	IN _DESCRIPCION			VARCHAR(80),
    IN _JUSTIFICACION		VARCHAR(80),
    IN _COD_CURSOS			INT(11)
)
begin 
	update capacidades set  DESCRIPCION = _DESCRIPCION,
							DESCRIPCION = _DESCRIPCION,
                            JUSTIFICACION = _JUSTIFICACION,
                            COD_CURSOS = _COD_CURSOS
    where COD_CAPACIDADES= _COD_CAPACIDADES;
end
$$

# PROCESO ELIMINAR
DELIMITER $$
CREATE PROCEDURE Proc_eliminar_competencias
(
	IN _COD_CAPACIDADES		INT(11)
)
begin 
	Delete from capacidades where COD_CAPACIDADES = _COD_CAPACIDADES;
end
$$

# PROCESO LISTAR
DELIMITER $$
CREATE PROCEDURE Proc_listar_competencias
(
)
begin 
	SELECT CAP.COD_CAPACIDADES, CAP.DESCRIPCION, CAP.JUSTIFICACION, CUR.DESCRIPCION AS CURSO FROM CAPACIDADES CAP
	INNER JOIN CURSOS CUR ON CAP.COD_CURSOS = CUR.COD_CURSOS;

end
$$

# PROCESO BUSCAR
DELIMITER $$
CREATE PROCEDURE Proc_buscar_competencias
(
	IN _COD_CURSOS	INT(11)
)
begin 
	SELECT CAP.COD_CAPACIDADES, CAP.DESCRIPCION, CAP.JUSTIFICACION FROM CAPACIDADES CAP
	INNER JOIN CURSOS CUR ON CAP.COD_CURSOS = CUR.COD_CURSOS
    WHERE CAP.COD_CURSOS = _COD_CURSOS;
end
$$

call Proc_buscar_competencias(1);




# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - CURSOS-GRADOS
# =========================================================

#PROCEDIMIENTO ALMACENADO PARA REGISTRAR
DELIMITER $$
CREATE PROCEDURE Proc_insertar_cursos_grados
(
	IN _COD_CURSOS 			INT(11), 
    IN _COD_GRADOS			INT(11), 
    IN _OBSERVACION			VARCHAR(80), 
    IN _COD_PERIODOS 		INT(11), 
    IN _COD_ESCOLAR 		INT(11), 
    IN _COD_INSTITUCION		INT(11)
)
begin
	INSERT INTO CURSOS_GRADOS (COD_CURSOS, COD_GRADOS, OBSERVACION, COD_PERIODOS, COD_ESCOLAR, COD_INSTITUCION)
	VALUES (_COD_CURSOS,_COD_GRADOS,_OBSERVACION,_COD_PERIODOS,_COD_ESCOLAR,_COD_INSTITUCION);
end
$$

# PROCEDIMIENTO ALMACENADO PARA BUSCAR

DELIMITER $$
CREATE PROCEDURE Proc_buscar_cursos_grados
(
	IN _COD_GRADOS 			INT(11)
)
begin
	SELECT CUR.DESCRIPCION AS CURSO, G.DESCRIPCION AS GRADO, CG.OBSERVACION, PER.DESCRIPCION_PERIODO, 
	   AE.ANIO_ESCOLAR, INS.NOMBRE
	FROM CURSOS_GRADOS CG
	INNER JOIN CURSOS CUR ON CG.COD_CURSOS = CUR.COD_CURSOS
	INNER JOIN GRADOS G ON CG.COD_GRADOS = G.COD_GRADOS
	INNER JOIN PERIODOS PER ON CG.COD_PERIODOS = PER.COD_PERIODOS
	INNER JOIN ANIO_ESCOLAR AE ON CG.COD_ESCOLAR = AE.COD_ESCOLAR
	INNER JOIN INSTITUCIONES INS ON CG.COD_INSTITUCION = INS.COD_INSTITUCION
WHERE CG.COD_GRADOS = _COD_GRADOS;
end
$$

-- buscamos mediante el call
call Proc_buscar_cursos_grados(1);





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - CURSOS
# =========================================================

# PROCEDIMIENTO ALMACENADO PARA REGISTRAR CURSOS
DELIMITER $$
CREATE PROCEDURE Proc_registrar_cursos
(
    IN _DESCRIPCION		VARCHAR(20)
)
BEGIN 
	insert into cursos (descripcion, n_capacidades, estado) values (_DESCRIPCION, 0, '1');
END
$$

# PROCESO MODIFICAR
DELIMITER $$
CREATE PROCEDURE Proc_modificar_cursos
(
	IN _COD_CURSOS		INT(11),
	IN _DESCRIPCION		VARCHAR(20)
)
begin 
	update Cursos set  Descripcion = _DESCRIPCION
    where Cod_Cursos= _COD_CURSOS;
end
$$

# PROCESO ELIMINAR
DELIMITER $$
CREATE PROCEDURE Proc_eliminar_cursos
(
	IN _COD_CURSOS		INT(11)
)
begin 
	Delete from Cursos where Cod_cursos = _COD_CURSOS;
end
$$

# PROCESO LISTAR
DELIMITER $$
CREATE PROCEDURE Proc_listar_cursos
(
)
begin 
	select Cod_Cursos, Descripcion, N_Capacidades from cursos
    where estado='1';
end
$$

# PROCESO BUSCAR
DELIMITER $$
CREATE PROCEDURE Proc_buscar_cursos
(
	IN _DESCRIPCION		VARCHAR(20)
)
begin 
	select Cod_Cursos, Descripcion, N_Capacidades from cursos
    where Descripcion = _DESCRIPCION;
end
$$

call Proc_buscar_cursos('matematica');

# Creamos nuestro Trigger para aumentar los criterios de evaluacion a la tabla Cursos
DELIMITER $$
CREATE TRIGGER TRI_AUMENTAR_CRITERIOS 
AFTER INSERT ON Capacidades FOR EACH ROW
BEGIN
Update Cursos set Cursos.N_Capacidades = Cursos.N_Capacidades + 1
where  Cursos.Cod_Cursos = NEW.Cod_Cursos;
END
$$





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - DISCAPACIDADES
# =========================================================

DELIMITER $$
CREATE PROCEDURE Proc_insertar_discapacidades
(
	IN _Descripcion	varchar(80)
)
begin 
	INSERT INTO DISCAPACIDADES (Descripcion) VALUES (_Descripcion);
end
$$

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





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - DOCENTES-CURSOS
# =========================================================

DELIMITER $$
CREATE PROCEDURE proc_registrar_DocentesCursos
(
	in _Cod_Persona		int(11),
    in _Cod_Curso		int(11)
)
BEGIN
	INSERT INTO DOCENTES_CURSOS (COD_PERSONA, COD_CURSOS) VALUES (_Cod_Persona,_Cod_Curso);
END
$$

DELIMITER $$
CREATE PROCEDURE proc_buscar_DocentesCursos
(
	IN _Cod_Persona	INT(11)	
)
BEGIN
	SELECT DOC.COD_PERSONA, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO, ', ', P.NOMBRES) AS DATOS, CUR.DESCRIPCION FROM DOCENTES_CURSOS DC
	INNER JOIN DOCENTES DOC ON DC.COD_PERSONA = DOC.COD_PERSONA
	INNER JOIN PERSONAS P ON DOC.COD_PERSONA = P.COD_PERSONA
	INNER JOIN CURSOS CUR ON DC.COD_CURSOS = CUR.COD_CURSOS
    WHERE DOC.COD_PERSONA = _Cod_Persona;
END
$$

CALL proc_buscar_DocentesCursos(2);





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - FASES ESCOLARES
# =========================================================

DELIMITER $$
CREATE PROCEDURE Proc_insertar_fases
(
	IN	_Cod_tipoFase 			INT(11),
	IN	_Cod_Escolar 			INT(11),
	IN	_Fecha_Desde 			DATE,
	IN	_Fecha_Hasta 			DATE, 
	IN	_Permitir_Asistencia 	VARCHAR(2), 
	IN	_Estado 				VARCHAR(20),
	IN	_Cod_Institucion 		INT(11)
)
begin
	INSERT INTO FASES_ESCOLARES (COD_TIPOFASE, COD_ESCOLAR, FECHA_DESDE, FECHA_HASTA, PERMITIR_ASISTENCIA, ESTADO, COD_INSTITUCION) 
    VALUES (_Cod_tipoFase,_Cod_Escolar,_Fecha_Desde,_Fecha_Hasta, _Permitir_Asistencia, _Estado, _Cod_Institucion);
end
$$

DELIMITER $$
CREATE PROCEDURE Proc_buscar_fases
(
	IN	_Cod_tipoFase 			INT(11)
)
begin
	SELECT FE.COD_FASE, TF.DESCRIPCION, AE.ANIO_ESCOLAR, FE.FECHA_DESDE, FE.FECHA_HASTA, FE.PERMITIR_ASISTENCIA, FE.ESTADO, INS.NOMBRE 
    FROM FASES_ESCOLARES FE
	INNER JOIN TIPO_FASE TF ON FE.COD_TIPOFASE = TF.COD_TIPOFASE
	INNER JOIN ANIO_ESCOLAR AE ON FE.COD_ESCOLAR = AE.COD_ESCOLAR
	INNER JOIN INSTITUCIONES INS ON FE.COD_INSTITUCION = INS.COD_INSTITUCION
    WHERE FE.COD_TIPOFASE = _Cod_tipoFase;
end
$$

CALL Proc_buscar_fases(1);





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - PERSONAS
# =========================================================

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


# FUNCION QUE NOS RETORNA EL ULTIMO REGISTRO INSERTADO DE LA TABLA PERSONAS
DELIMITER $$
CREATE FUNCTION personas() RETURNS int
BEGIN
  DECLARE salida  int DEFAULT 0;
  SET salida = (SELECT MAX(cod_persona) AS id FROM personas);
  RETURN salida;
END
$$





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - TIPO DOCUMENTO - PERSONAS
# =========================================================

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





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - DOCENTES
# =========================================================

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


# PROCEDIMIENTO ALMACENADO PARA LISTAR DOCENTES
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

# PROCEDIMIENTO ALMACENADO PARA BUSCAR DOCENTES
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





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - ESTUDIANTES
# =========================================================

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





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - GRADOS
# =========================================================

DELIMITER $$
CREATE FUNCTION cursos() RETURNS int
BEGIN
  DECLARE salida  int DEFAULT 0;
  SET salida = (select count(*) from cursos);
  RETURN salida;
END
$$


DELIMITER $$
CREATE PROCEDURE Proc_insertar_grados
(
	IN _Descripcion		varchar(50),
    IN _Cod_DisenioC	int(11)
)
begin
	DECLARE _cursos int(11) DEFAULT 0;
    SET _cursos = (select cursos());
	insert into grados (Descripcion, N_secciones, N_Cursos, Cod_DisenioC) values (_Descripcion, 0,_cursos, _cod_DisenioC);
end
$$

DELIMITER $$
CREATE PROCEDURE Proc_buscar_grado
(
	IN _Descripcion	varchar(50)
)
begin
	select Cod_Grados, Descripcion, N_secciones, N_Cursos from grados
    where Descripcion = _Descripcion;
end
$$

call Proc_buscar_grado('Primero');





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - DISEÑO CURRICULAR
# =========================================================

DELIMITER $$
CREATE PROCEDURE Proc_insertar_disenio
(
    IN _DESCRIPCION 	VARCHAR(50),
    IN _ANIO			DATE
)
begin
	INSERT INTO DISENIO_CURRICULAR (DESCRIPCION, ANIO) VALUES (_DESCRIPCION, _ANIO);
end
$$

DELIMITER $$
CREATE PROCEDURE Proc_listar_disenio
(
)
begin 
	select Cod_DisenioC, Descripcion, Anio from disenio_curricular;
end
$$

call Proc_listar_disenio();





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - MATRICULAS-CURSOS
# =========================================================

DELIMITER $$
CREATE PROCEDURE Proc_MatriculaCurso_Insertar
(
	IN _Cod_Matricula	int(11),
    IN _Cod_Persona		int(11),
    IN _Cod_Cursos		int(11)
)
BEGIN
	INSERT INTO MATRICULAS_CURSOS (COD_MATRICULA, COD_PERSONA, COD_CURSOS) VALUES (_Cod_Matricula,_Cod_Persona,_Cod_Cursos);
END
$$


DELIMITER $$
CREATE PROCEDURE Proc_Buscar_MatriculaCurso
(
	IN _Cod_Matricula	int(11)
)
BEGIN
	SELECT M.COD_MATRICULA, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO, ', ', P.NOMBRES) AS ESTUDIANTE, 
		   CONCAT(PP.APE_PATERNO,' ',PP.APE_MATERNO, ', ', PP.NOMBRES) AS DOCENTE, CUR.DESCRIPCION AS CURSO
	FROM MATRICULAS_CURSOS MC
		INNER JOIN MATRICULAS M  ON MC.COD_MATRICULA = M.COD_MATRICULA
		INNER JOIN ESTUDIANTES EST  ON M.COD_PERSONA = EST.COD_PERSONA
		INNER JOIN PERSONAS P ON EST.COD_PERSONA = P.COD_PERSONA
		INNER JOIN DOCENTES DOS  ON MC.COD_PERSONA = DOS.COD_PERSONA
		INNER JOIN PERSONAS PP ON DOS.COD_PERSONA = PP.COD_PERSONA
		INNER JOIN CURSOS CUR ON MC.COD_CURSOS = CUR.COD_CURSOS
	WHERE M.COD_MATRICULA = _Cod_Matricula;
END
$$

CALL Proc_Buscar_MatriculaCurso(1);





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - PERIODOS DE EVALUACION
# =========================================================

# PROCEDIMIENTOS ALMACENADOS PARA TIPOS PERIODOS

DELIMITER $$
CREATE PROCEDURE proc_registrar_TiposPeriodos
(
    IN _Descripcion	varchar(20)
)
BEGIN  
	INSERT INTO TIPOS_PERIODOS (DESCRIPCION) VALUES (_Descripcion);
END
$$

DELIMITER $$
CREATE PROCEDURE proc_listar_TiposPeriodos
(
)
BEGIN 
	SELECT * FROM TIPOS_PERIODOS;
END
$$

Call proc_listar_TiposPeriodos();

# PROCEDIMIENTOS ALMACENADOS PARA PERIODOS

DELIMITER $$
CREATE PROCEDURE proc_registrar_periodos
(
	IN _N_Descripcion		varchar(15),
    IN _Anio_Escolar		date,
    IN _Cod_Tipo			int(11),
    IN _Descripcion_periodo	varchar(20),
    IN _Fecha_inicio		date,
    IN _Fecha_Fin			date,
    IN _Estado				varchar(20),
    IN _Cod_Escolar			int(11),
    IN _Cod_Institucion		int(11)
)
BEGIN 
	INSERT INTO PERIODOS (N_DESCRIPCION, ANIO_ESCOLAR, COD_TIPO, DESCRIPCION_PERIODO, 
                          FECHA_INICIO, FECHA_FIN, ESTADO, COD_ESCOLAR, COD_INSTITUCION)
	VALUES (_N_Descripcion, _Anio_Escolar,_Cod_Tipo, _Descripcion_periodo, _Fecha_inicio, _Fecha_Fin, 
			_Estado, _Cod_Escolar,_Cod_Institucion);
END
$$


DELIMITER $$
CREATE PROCEDURE proc_buscar_periodos
(
	IN _fecha_ini 	date,
    IN _fecha_fin	date
)
BEGIN 
	SELECT PER.COD_PERIODOS, PER.DESCRIPCION_PERIODO, PER.FECHA_INICIO, PER.FECHA_FIN, PER.ESTADO
	FROM PERIODOS PER
    WHERE PER.FECHA_INICIO BETWEEN _fecha_ini and _fecha_fin;
END
$$

call proc_buscar_periodos('2017-01-01','2017-12-30');





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - PERSONA DOCUMENTO
# =========================================================

DELIMITER $$
CREATE PROCEDURE proc_registrar_PersonaDocumento
(
	IN _Cod_Documento		int(11),
    IN _Cod_Persona			int(11),
    IN _Numero_Identidad	Varchar(15)
)
BEGIN 
	INSERT INTO TIPO_DOCUMENTO_PERSONAS (COD_DOCUMENTO, COD_PERSONA, NUMERO_IDENTIDAD) 
    VALUES (_Cod_Documento,_Cod_Persona,_Numero_Identidad);
END
$$

DELIMITER $$
CREATE PROCEDURE proc_buscar_PersonaDocumento
(
	IN _Cod_Documento		int(11)
)
BEGIN
	SELECT T.DESCRIPCION, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO, ', ', P.NOMBRES) AS DATOS, TIP.NUMERO_IDENTIDAD FROM TIPO_DOCUMENTO_PERSONAS TIP
	INNER JOIN TIPO_DOCUMENTO T ON TIP.COD_DOCUMENTO = T.COD_DOCUMENTO
	INNER JOIN PERSONAS P ON TIP.COD_PERSONA = P.COD_PERSONA
    WHERE TIP.COD_DOCUMENTO = _Cod_Documento;
END
$$

CALL proc_buscar_PersonaDocumento(1);





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - SECCIONES
# =========================================================

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

call Proc_buscar_secciones(1);





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - TIPOS DOCUMENTOS
# =========================================================

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





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - TURNOS
# =========================================================

DELIMITER $$
CREATE PROCEDURE Proc_insertar_turnos
(
	IN _Descripcion	varchar(20)
)
begin
	INSERT INTO TURNOS (Descripcion) VALUES (_Descripcion);
end
$$


DELIMITER $$
CREATE PROCEDURE Proc_buscar_turnos
(
	IN _Descripcion	varchar(20)
)
begin
	select * from turnos
    where Descripcion = _Descripcion;
end
$$

CALL Proc_buscar_turnos('MAÑANA');





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - MATRICULAS
# =========================================================

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

Call proc_buscar_matricula('15487815457847');





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - EVALUACIONES
# =========================================================
delimiter $$
Create Procedure proc_registrar_evaluaciones
(
	in _Promedio_final	char(2),
    in _Cod_Persona		int(11),
    in _Cod_Curso		int(11),
    in _Fecha			date,
    in _Hora			time,
    in _Cod_Grados		int(11),
    in _Cod_Periodos	int(11),
    in _Cod_Escolar		int(11),
    in _Cod_Institucion	int(11)
)
begin 
	insert into evaluaciones (Promedio_final, Cod_Persona, Cod_Cursos, Fecha, Hora, Cod_Grados, Cod_Periodos, Cod_Escolar, Cod_Institucion)
	values (_Promedio_final, _Cod_Persona, _Cod_Curso, _Fecha, _Hora, _Cod_Grados, _Cod_Periodos, _Cod_Escolar, _Cod_Institucion);
end
$$

# FUNCION QUE NOS RETORNA EL ULTIMO REGISTRO INSERTADO DE LA TABLA EVALUACIONES
DELIMITER $$
CREATE FUNCTION evaluaciones() RETURNS int
BEGIN
  DECLARE salida  int DEFAULT 0;
  SET salida = (SELECT MAX(Cod_Evaluacion) AS id FROM Evaluaciones);
  RETURN salida;
END
$$





# =========================================================	
# 	     PROCEDIMIENTOS ALMACENADOS - DETALLES EVALUACIONES
# =========================================================
delimiter $$
create procedure proc_registrar_detalle
(
	in _calificacion	char(1),
    in _Cod_Matricula	int(11)
)
begin

	DECLARE _Cod_Evaluacion int(11) DEFAULT 0;
    SET _Cod_Evaluacion = (select evaluaciones());
	insert into detalles_evaluaciones (calificacion, Cod_Evaluacion, Cod_Matricula)
	values (_calificacion, _Cod_Evaluacion, _Cod_Matricula);
end
$$