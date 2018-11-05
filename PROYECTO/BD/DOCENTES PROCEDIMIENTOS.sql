
######################################### PROCEDIMIENTO PERSONAS #########################################
# REGISTRAR PERSONAS
DELIMITER $$
CREATE PROCEDURE PRO_REGISTRAR_PERSONAS(
    IN _APE_PATERNO 		VARCHAR(80),
	IN _APE_MATERNO 		VARCHAR(80),
	IN _NOMBRES 			VARCHAR(80),
	IN _SEXO 				CHAR(1),
    IN _DNI              	VARCHAR(8),
	IN _ESTADO_CIVIL 		VARCHAR(15),
	IN _FECHA_NAC 			DATE,
	IN _DIRECCION 			VARCHAR(80),
	IN _TELEFONO 			INT(9),
	IN _CORREO 				VARCHAR(50)
)
BEGIN
	INSERT INTO PERSONAS (APE_PATERNO, APE_MATERNO, NOMBRES, SEXO, DNI, ESTADO_CIVIL, FECHA_NAC, DIRECCION, TELEFONO, CORREO) 
    VALUES (_APE_PATERNO, _APE_MATERNO, _NOMBRES, _SEXO, _DNI,_ESTADO_CIVIL, _FECHA_NAC, _DIRECCION, _TELEFONO, _CORREO);
END $$

######################################### PROCEDIMIENTO DOCENTES #########################################
# REGISTRAR DOCENTES	
DELIMITER $$
CREATE PROCEDURE PRO_REGISTRAR_DOCENTE(
	IN _COD_PERSONA         INT (11),
    IN _CARGO 				VARCHAR(50),
    IN _FUNCION 			VARCHAR(50),
    IN _ESTADO 				CHAR(1),
    IN _NIVEL_INSTRUCCION 	VARCHAR(50),
    IN _CARRERA_PROFESIONAL VARCHAR(50),
    IN _FECHA_INICIO 		DATE,
    IN _FECHA_FIN 			DATE
)
BEGIN
	INSERT INTO DOCENTES (COD_PERSONA, CARGO, FUNCION, ESTADO, NIVEL_INSTRUCCION, CARRERA_PROFESIONAL, FECHA_INICIO, FECHA_FIN) 
    VALUES (_COD_PERSONA, _CARGO, _FUNCION, _ESTADO, _NIVEL_INSTRUCCION, _CARRERA_PROFESIONAL, _FECHA_INICIO, _FECHA_FIN);
END $$

# LISTAR DOCENTES
DELIMITER $$
CREATE PROCEDURE PRO_LISTAR_DOCENTES(
)
BEGIN 
	SELECT DOC.COD_PERSONA, PER.APE_PATERNO, PER.APE_MATERNO, PER.NOMBRES, PER.DNI, 
           DOC.CARGO, DOC.FUNCION, DOC.ESTADO, DOC.NIVEL_INSTRUCCION, DOC.CARRERA_PROFESIONAL, DOC.FECHA_INICIO, DOC.FECHA_FIN
    FROM DOCENTES DOC
    INNER JOIN PERSONAS PER ON PER.COD_PERSONA = DOC.COD_PERSONA; 
END $$


# BUSCAR DOCENTES
DELIMITER $$
CREATE PROCEDURE PRO_BUSCAR_DOCENTES(
	IN _DNI              	VARCHAR(8) 
)
BEGIN 
	SELECT DOC.COD_PERSONA, PER.DNI, PER.APE_PATERNO, PER.APE_MATERNO, PER.NOMBRES,  
           DOC.CARGO, DOC.FUNCION, DOC.ESTADO, DOC.NIVEL_INSTRUCCION, DOC.CARRERA_PROFESIONAL, DOC.FECHA_INICIO, DOC.FECHA_FIN
    FROM DOCENTES DOC
    INNER JOIN PERSONAS PER ON PER.COD_PERSONA = DOC.COD_PERSONA
    WHERE PER.DNI = _DNI ; 
END $$







