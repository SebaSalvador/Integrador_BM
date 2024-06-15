DROP DATABASE IF EXISTS bdprestamos;
CREATE DATABASE bdprestamos;
USE bdprestamos;

CREATE TABLE tb_tipoUsuario (
	id_tipo			integer			NOT NULL,
	rango			varchar(32)		NOT NULL,
	descripcion		varchar(64)		NOT NULL,
	PRIMARY KEY(id_tipo)
);

CREATE TABLE tb_persona (
	id_per			integer			NOT NULL,
    nom_ape			varchar(64)		NOT NULL,
    edad			integer			NOT NULL,
    correo			varchar(64)		NOT NULL,
    direccion		varchar(64)		NULL,
    telefono		varchar(16)		NOT NULL,
    PRIMARY KEY(id_per)
);

CREATE TABLE tb_usuario (
	id_per			integer			NOT NULL,
	id_tipo			integer			NOT NULL,
    pass			varchar(16)		NOT NULL,
    estado			varchar(16)		NOT NULL,
    PRIMARY KEY(id_per),
    FOREIGN KEY(id_per) REFERENCES tb_persona(id_per),
    FOREIGN KEY(id_tipo) REFERENCES tb_tipoUsuario(id_tipo)
);

CREATE TABLE tb_sancion (
	id_san			integer			NOT NULL,
    id_per			integer			NOT NULL,
    dias_san		integer			NOT NULL,
    fec_ini			date			NOT NULL,
    razon			varchar(32)		NOT NULL,
    PRIMARY KEY(id_san),
    FOREIGN KEY(id_per) REFERENCES tb_persona(id_per)
);

CREATE TABLE tb_mensaje (
	id_men			integer			NOT NULL,
    id_per			integer			NOT NULL,
    asunto			varchar(32)		NOT NULL,
    detalle			text			NOT NULL,
    fec_env			date			NOT NULL,
    hor_env			varchar(16)		NOT NULL,
    estado			varchar(16)		NOT NULL,
    PRIMARY KEY(id_men),
    FOREIGN KEY(id_per) REFERENCES tb_persona(id_per)
);

CREATE TABLE tb_estado (
	id_est			integer			NOT NULL,
    estado			varchar(32)		NOT NULL,
    descripcion		text			NOT NULL,
    PRIMARY KEY(id_est)
);

CREATE TABLE tb_categoria (
	id_cat			integer			NOT NULL,
    nombre			varchar(32)		NOT NULL,
    PRIMARY KEY(id_cat)
);

CREATE TABLE tb_libro (
	id_lib			integer			NOT NULL,
    id_est			integer			NOT NULL,
    id_cat			integer			NOT NULL,
    titulo			varchar(32)		NOT NULL,
    descripcion		text			NULL,
    autor			varchar(64)		NOT NULL,
    fec_pub			date			NOT NULL,
    PRIMARY KEY(id_lib),
    FOREIGN KEY(id_est) REFERENCES tb_estado(id_est),
    FOREIGN KEY(id_cat) REFERENCES tb_categoria(id_cat)
);

CREATE TABLE tb_prestamo (
	id_pre			integer			NOT NULL,
    id_per			integer			NOT NULL,
    id_lib			integer			NOT NULL,
    fec_pre			date			NOT NULL,
    hor_pre			varchar(16)		NOT NULL,
    fec_dev			date			NOT NULL,
    hor_dev			varchar(16)		NOT NULL,
    PRIMARY KEY(id_pre),
    FOREIGN KEY(id_per) REFERENCES tb_persona(id_per),
    FOREIGN KEY(id_lib)	REFERENCES tb_libro(id_lib)
);

CREATE TABLE tb_observacion (
	id_lib			integer			NOT NULL,
    descripcion		varchar(32)		NOT NULL,
    fec_obs			date			NOT NULL,
    condicion		varchar(16)		NOT NULL,
    PRIMARY KEY(id_lib),
    FOREIGN KEY(id_lib) REFERENCES tb_libro(id_lib)
);


/*Insertando datos a las tablas*/

DELETE FROM tb_tipousuario;

INSERT INTO tb_tipousuario VALUES(0, 'Cliente', 'Solo consultas de libros y registro de prestamos');
INSERT INTO tb_tipousuario VALUES(1, 'Empleado', 'Gestion de prestamos y consultas sin restriccion');
INSERT INTO tb_tipousuario VALUES(2, 'Administrador', 'Todos los permisos');

DELETE FROM tb_categoria;

INSERT INTO tb_categoria VALUES(10,'Literarios y Linguisticos');
INSERT INTO tb_categoria VALUES(11,'Cientificos');
INSERT INTO tb_categoria VALUES(12,'Tecnicos');
INSERT INTO tb_categoria VALUES(13,'Divulgativos');
INSERT INTO tb_categoria VALUES(14,'Ilustrativos');

DELETE FROM tb_estado;
/*
No disponible: El libro no esta disponible por diversos motivos, tales como: daños o esta desaparecido
Disponible: El libro esta disponible para un nuevo prestamo
Solicitado: El libro ha sido solicitado por un usuario y esta en espera de ser recogido
Prestado: El libro ha sido prestado a un usuario
Carro de estanteria: El libro ha sido entregado y esta en proceso de ser devuelto a la estanteria
*/

INSERT INTO tb_estado VALUES(0, 'No disponible', 'El libro no esta disponible por diversos motivos, tales como: daños o esta desaparecido');
INSERT INTO tb_estado VALUES(1, 'Disponible', 'El libro esta disponible para un nuevo prestamo');
INSERT INTO tb_estado VALUES(2, 'Solicitado', 'El libro ha sido solicitado por un usuario y esta en espera de ser recogido');
INSERT INTO tb_estado VALUES(3, 'Prestado', 'El libro ha sido prestado a un usuario');
INSERT INTO tb_estado VALUES(4, 'Carro de estanteria', 'El libro ha sido entregado y esta en proceso de ser devuelto a la estanteria');

DELETE FROM tb_persona;

INSERT INTO tb_persona VALUES(52336803, 'PAOLO GABRIEL RODRIGEZ PEREZ', 22, 'rodriguezpaolog@gmail.com', 'Masia Guadalupe 9 Puerta 234', '995200665');
INSERT INTO tb_persona VALUES(74588241, 'ERNESTO GARCIA MEDINA', 21, 'garciaernesto@hotmail.com', 'Vía Verónica 74', '902533687');
INSERT INTO tb_persona VALUES(53123564, 'MARIA ELENA ZAPATA SANCHEZ', 20, 'zapatamariae@gmail.com', 'Riera Rebeca 14', '995236708');

DELETE FROM tb_mensaje;

DELETE FROM tb_libro;

INSERT INTO tb_libro VALUES(100, 1, 10, 'El principito', 'El Principito narra la historia de un niño príncipe que vive en un pequeño asteroide y que cae a la Tierra, donde conoce a un piloto varado en el desierto. Ambos entablan una conversación en clave poética donde hablan de filosofía, de crítica social, del amor, del honor y de mucho de lo que nos hace humanos.','Antoine de Saint Exupery', '1951-09-20');
INSERT INTO tb_libro VALUES(101, 1, 11, 'Cosmos','Cosmos trata de la ciencia en su contexto humano más amplio y explica cómo la ciencia y la civilización se desarrollan conjuntamente. La obra aborda también el tema de las misiones espaciales destinadas a explorar los planetas más próximos a la Tierra, del origen de la vida, de la muerte del Sol, de la evolución de las galaxias y de los orígenes de la materia, los soles y los mundos, así como también los más recientes descubrimientos sobre la vida fuera de la Tierra.','Carl Sagan','1981-01-01');
INSERT INTO tb_libro VALUES(102, 1, 12, 'Code Complete (2 Edition)', 'Ampliamente considerada una de las mejores guías prácticas de programación, el CODE COMPLETE original de Steve McConnell ha ayudado a los desarrolladores a escribir mejor software durante más de una década. Ahora, este libro clásico ha sido completamente actualizado y revisado con prácticas de vanguardia y cientos de nuevos ejemplos de código que ilustran el arte y la ciencia de la construcción de software.', 'Steve McConnell', '2004-07-07');

DELETE FROM tb_usuario;
/*
Estados:
Activo, Desactivado, Penalizado
*/

INSERT INTO tb_usuario VALUES(52336803, 0, '123456', 'Activo');
INSERT INTO tb_usuario VALUES(74588241, 0, 'abcdef', 'Activo');
INSERT INTO tb_usuario VALUES(53123564, 1, 'emp24*', 'Activo');


/*Funciones*/

DELIMITER $$
CREATE FUNCTION validarLogin (
    user_id VARCHAR(64),
    password_u VARCHAR(16)
) RETURNS BOOLEAN
BEGIN
    DECLARE existe BOOLEAN;
    SELECT EXISTS(select tp.id_per, tp.correo, tu.pass from tb_persona tp
                  inner join tb_usuario tu on tp.id_per =tu.id_per 
                  where tp.correo = user_id
                  and tu.pass = password_u) INTO existe;
    RETURN existe;
END$$
DELIMITER ;


/*Procedures*/
DELIMITER $$

CREATE PROCEDURE registrarUsuario (
    IN p_dni INT(11),
    IN p_nombre VARCHAR(64),
    IN p_edad INT(11),
    IN p_correo VARCHAR(64),
    IN p_direccion VARCHAR(64),
    IN p_telefono VARCHAR(16),
    IN p_tipo_usuario INT(11),
    IN p_contraseña VARCHAR(16),
    IN p_estado VARCHAR(16)
)
BEGIN

    -- Insertar en tb_persona
    INSERT INTO tb_persona VALUES (p_dni, p_nombre, p_edad, p_correo, p_direccion, p_telefono);

    -- Insertar en tb_usuario
    INSERT INTO tb_usuario VALUES (p_dni, p_tipo_usuario, p_contraseña, p_estado);
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE traerUsuario (
    correo_u VARCHAR(64),
    password_u VARCHAR(16)
)
BEGIN
    select tp.id_per ,tt.id_tipo from tb_persona tp 
    inner join tb_usuario tu on tu.id_per =tp.id_per
    inner join tb_tipousuario tt on tu.id_tipo =tt.id_tipo 
    where tp.correo = correo_u
    and tu.pass = password_u;
END $$

DELIMITER ;
