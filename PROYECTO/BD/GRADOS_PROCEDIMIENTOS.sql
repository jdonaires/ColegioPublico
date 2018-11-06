use bd_colegioprimaria;



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



select * from grados