#usamos la base de datos

use bd_colegioprimaria;

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


CALL Proc_insertar_disenio('DISEÑO CURRICULAR NACIONAL 2018','2017-02-25');


DELIMITER $$
CREATE PROCEDURE Proc_listar_disenio
(
)
begin 
	select Cod_DisenioC, Descripcion, Anio from disenio_curricular;
end
$$

call Proc_listar_disenio();