#UTILIZAMOS LA BASE DE DATOS
USE BD_COLEGIOPRIMARIA;

# INSERCIONES DE LA TABLA: CURSOS

#insert into cursos (descripcion, n_capacidades, estado) values ('matematica', 0, '1');
#insert into cursos (descripcion, n_capacidades, estado) values ('lenguaje', 0 , '1');
#insert into cursos (descripcion, n_capacidades, estado) values ('ciencia', 0, '1');

#select * from cursos;

# PROCEDIMIENTO ALMACENADO PARA CURSOS
# PROCESO REGISTRO

DELIMITER $$
CREATE PROCEDURE Proc_registrar_cursos
(
    IN _DESCRIPCION		VARCHAR(20)
)
BEGIN 
	insert into cursos (descripcion, n_capacidades, estado) values (_DESCRIPCION, 0, '1');
END
$$

# CALL Proc_registrar_cursos('IDIOMA');


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

#CALL Proc_modificar_cursos(3,'Personal Social');

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

#CALL Proc_eliminar_cursos(3);


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


call Proc_listar_cursos();


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