#UTILIZAMOS LA BASE DE DATOS
USE BD_COLEGIOPRIMARIA;

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

call Proc_MatriculaCurso_Insertar(3,2,1);

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

/*
select * from personas

select mat.Cod_Matricula, mat.Cod_Persona, concat(p.ape_paterno,' ',p.ape_materno, ', ', p.nombres) as matriculado
 from matriculas mat
 inner join personas p on mat.Cod_Persona = p.Cod_Persona;


select * from docentes_cursos;
select * from docentes;

select c.Descripcion from docentes_cursos dc
inner join cursos c on dc.Cod_Cursos = c.Cod_Cursos
where dc.Cod_Persona = 2; 

select Distinct dc.Cod_persona, concat(p.ape_paterno,' ',p.ape_materno, ', ', p.nombres) as docentes from docentes_cursos dc
inner join Docentes doc on dc.Cod_persona = doc.Cod_persona
inner join Personas p on doc.Cod_persona = p.Cod_persona


where dc.Cod_Persona = 2; 


select Distinct cod_persona,  from docentes_cursos

select * from docentes_cursos


select * from MATRICULAS_CURSOS

*/