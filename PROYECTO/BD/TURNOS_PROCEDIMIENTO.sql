use bd_colegioprimaria;

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