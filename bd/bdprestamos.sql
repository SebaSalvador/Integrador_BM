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
/*
- El estado del usuario cambia a penalizado solo si presenta alguna sancion activa
*/
CREATE TABLE tb_usuario (
	id_per			integer			NOT NULL,
	id_tipo			integer			NOT NULL,
    pass			varchar(16)		NOT NULL,
    estado			varchar(16)		NOT NULL,
    PRIMARY KEY(id_per),
    FOREIGN KEY(id_per) REFERENCES tb_persona(id_per),
    FOREIGN KEY(id_tipo) REFERENCES tb_tipoUsuario(id_tipo)
);
/*
- Una persona solo tiene una sancion cuando entrega un libro fuera del plazo de prestamo o el libro presente una observacion
- En caso de que el libro entregado presente una observacion los dias_san son 14 dias 
- Calculo dias sancion, si es fuera de plazo:
    dias_san = fec_ent - fec_dev (fechas traidas de tb_prestamo)
- La sancion comienza desde la fecha de inicio indicada, pero los dias cuentan a partir del siguiente dia
- Calculo fecha de finalizacion: (Ultima fecha de sancion)
    fec_fin = fec_ini + $dias_san 
Estados: (para controlar que se muestra al usuario)
- Activo
- Inactivo

*/
CREATE TABLE tb_sancion (
	id_san			integer			NOT NULL AUTO_INCREMENT,
    id_per			integer			NOT NULL,
    dias_san		integer			NOT NULL,
    fec_ini			date			NOT NULL,
    fec_fin         date            NOT NULL,
    razon			varchar(32)		NOT NULL,
    estado          varchar(16)     NOT NULL,
    PRIMARY KEY(id_san),
    FOREIGN KEY(id_per) REFERENCES tb_persona(id_per)
)AUTO_INCREMENT = 10000;

CREATE TABLE tb_estado (
	id_est			integer			NOT NULL,
    estado			varchar(32)		NOT NULL,
    descripcion		text			NOT NULL,
    PRIMARY KEY(id_est)
);

CREATE TABLE tb_categoria (
	id_cat			integer			NOT NULL AUTO_INCREMENT,
    nombre			varchar(32)		NOT NULL,
    PRIMARY KEY(id_cat)
)AUTO_INCREMENT = 10;

CREATE TABLE tb_libro (
	id_lib			integer			NOT NULL AUTO_INCREMENT,
    id_est			integer			NOT NULL,
    id_cat			integer			NOT NULL,
    titulo			varchar(32)		NOT NULL,
    descripcion		text			NULL,
    autor			varchar(64)		NOT NULL,
    fec_pub			date			NOT NULL,
    PRIMARY KEY(id_lib),
    FOREIGN KEY(id_est) REFERENCES tb_estado(id_est),
    FOREIGN KEY(id_cat) REFERENCES tb_categoria(id_cat)
)AUTO_INCREMENT = 100;
/*
Estados del prestamo:
Pendiente : Comprende desde la fecha de prestamo hasta 2 horas max
En curso : Comprende desde que el usuario recoja el libro hasta la fecha de devolucion
Pendiente Devolucion: Comprende desde fecha de devolucion hasta que el usuario devuelve el libro 
Finalizado: Se marca cuando el usuario devuelve el libro, sea a tiempo o con retraso

- En prestamos en estado pendiente de entrega, los dias de sancion se calculan:
    dias_san = fec_ent - fec_dev (no importa la hora de entrega)
¿Que pasa si una persona entrega el libro el 15/06/2024 a las 18:00 PM, sabiendo que su fecha de devolucion es 
el 15/06/2024 a las 16:00 PM? ¿Hay sancion? No
¿Que pasa si una persona demora mucho en entregar un libro? Pasado 7 dias se le agrega una observacion de extraviado
*/
CREATE TABLE tb_prestamo (
	id_pre			integer       NOT NULL AUTO_INCREMENT,
    id_per			integer			NOT NULL,
    id_lib			integer			NOT NULL,
    fec_pre			date			NOT NULL,
    hor_pre			varchar(16)		NOT NULL,
    fec_dev			date			NOT NULL,
    hor_dev			varchar(16)		NOT NULL, 
    estado			varchar(32)		NOT NULL,
    PRIMARY KEY(id_pre),
    FOREIGN KEY(id_per) REFERENCES tb_persona(id_per),
    FOREIGN KEY(id_lib)	REFERENCES tb_libro(id_lib)
) AUTO_INCREMENT=1000;

/*
Descripciones:
- El libro ha sido manipulado o rasgado
- El libro fue extraviado

Condiciones: (Los libros en estado recuperado ya no se muestran en empleado)
- Inutilizable
- En solucion
- Recuperado

- Solo los libros que no tengan observaciones o estan en condicion Recuperado pueden mostrarse a
las personas
- Un libro puede tener muchas observaciones en su vida util
- Solo puede haber una observacion en condicion Inutilizable o En solucion por libro
*/
CREATE TABLE tb_observacion (
    id_obs          integer         NOT NULL AUTO_INCREMENT,
	id_lib			integer			NOT NULL,
    descripcion		varchar(32)		NOT NULL,
    fec_obs			date			NOT NULL,
    condicion		varchar(16)		NOT NULL,
    PRIMARY KEY(id_obs),
    FOREIGN KEY(id_lib) REFERENCES tb_libro(id_lib)
)AUTO_INCREMENT = 100000;


/*Insertando datos a las tablas*/

DELETE FROM tb_tipousuario;

INSERT INTO tb_tipousuario VALUES(0, 'Cliente', 'Solo consultas de libros y registro de prestamos');
INSERT INTO tb_tipousuario VALUES(1, 'Empleado', 'Gestion de prestamos y consultas sin restriccion');
INSERT INTO tb_tipousuario VALUES(2, 'Administrador', 'Todos los permisos');

DELETE FROM tb_categoria;

INSERT INTO tb_categoria VALUES(null,'Literarios y Linguisticos');
INSERT INTO tb_categoria VALUES(null,'Cientificos');
INSERT INTO tb_categoria VALUES(null,'Tecnicos');
INSERT INTO tb_categoria VALUES(null,'Divulgativos');
INSERT INTO tb_categoria VALUES(null,'Ilustrativos');

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
INSERT INTO tb_persona VALUES(87654321, 'PEDRO ERNESTO GONZALES TORRES', 25, 'gonzalespedroe@gmail.com', 'Vía Enrique 12', '995500123');
INSERT INTO tb_persona VALUES(12345678, 'MIRANDA MILAGROS PEREZ', 26, 'milagrosmiranda@gmail.com', 'Pasaje Adan Mejia 403', '800500200');
INSERT INTO tb_persona VALUES(77889933, 'UMBERTO EINSTEIN URETA', 18, 'einsteinumberto@gmail.com', 'Jr. Mariscal Miller 458', '988222777');

DELETE FROM tb_libro;

INSERT INTO tb_libro VALUES(null, 1, 10, 'El principito', 'El Principito narra la historia de un niño príncipe que vive en un pequeño asteroide y que cae a la Tierra, donde conoce a un piloto varado en el desierto. Ambos entablan una conversación en clave poética donde hablan de filosofía, de crítica social, del amor, del honor y de mucho de lo que nos hace humanos.','Antoine de Saint Exupery', '1951-09-20');
INSERT INTO tb_libro VALUES(null, 1, 12, 'Code Complete (2 Edition)', 'Ampliamente considerada una de las mejores guías prácticas de programación, el CODE COMPLETE original de Steve McConnell ha ayudado a los desarrolladores a escribir mejor software durante más de una década. Ahora, este libro clásico ha sido completamente actualizado y revisado con prácticas de vanguardia y cientos de nuevos ejemplos de código que ilustran el arte y la ciencia de la construcción de software.', 'Steve McConnell', '2004-07-07');

INSERT INTO tb_libro VALUES(null, 1, 10, '1984', 'Una distopía clásica que explora el control totalitario y el poder del lenguaje para manipular la realidad y la percepción pública', 'George Orwell', '1949-06-08');
INSERT INTO tb_libro VALUES(null, 1, 10, 'El nombre del viento', 'Esta novela de fantasía sigue la vida de Kvothe, un músico y mago legendario, explorando la importancia de la narrativa y la palabra en la construcción de identidades y leyendas.', 'Patrick Rothfuss', '2007-03-27');
INSERT INTO tb_libro VALUES(null, 1, 10, 'El perfume', 'Una novela que examina el poder del olfato y cómo se entrelaza con la identidad y la percepción, utilizando un lenguaje evocador y poético.', 'Patrick Süskind', '1985-00-00');
INSERT INTO tb_libro VALUES(null, 1, 10, 'El lector', 'Esta obra narra la relación entre un joven y una mujer mayor en la Alemania post-nazi, explorando temas de memoria, literatura y responsabilidad personal.', 'Bernhard Schlink', '1995-00-00');

INSERT INTO tb_libro VALUES(null, 1, 11, 'Breves respuestas a las grandes preguntas', 'En este libro póstumo, Hawking aborda preguntas fundamentales sobre el universo, la inteligencia artificial, el futuro de la humanidad y otros temas científicos de gran relevancia.', 'Stephen Hawking', '2018-10-16');
INSERT INTO tb_libro VALUES(null, 1, 11, 'Sapiens: De animales a dioses', 'Este libro ofrece una visión panorámica de la historia de la humanidad desde la evolución hasta la revolución científica, explorando cómo las ideas y los avances científicos han moldeado nuestra sociedad.', 'Yuval Noah Harari', '2011-00-00');
INSERT INTO tb_libro VALUES(null, 1, 11, 'Cosmos', 'Una obra clásica que explora el universo desde una perspectiva científica y filosófica, abordando temas como el origen de la vida, el cosmos, y la búsqueda de vida extraterrestre.', 'Carl Sagan', '1980-00-00');
INSERT INTO tb_libro VALUES(null, 1, 11, 'El gen: Una historia personal', 'Este libro ofrece una exploración profunda de la genética y cómo la comprensión del ADN ha transformado nuestra comprensión de la biología y la medicina.', 'Siddhartha Mukherjee', '2016-05-17');

INSERT INTO tb_libro VALUES(null, 1, 12, 'Clean Code: A Handbook of Agile Software Craftsmanship', 'Este libro es un referente en el desarrollo de software, enfocado en principios y prácticas para escribir código limpio y mantenible.', 'Robert C. Martin', '2012-06-19');
INSERT INTO tb_libro VALUES(null, 1, 12, 'Thinking, Fast and Slow', 'Este libro explora la psicología del juicio y la toma de decisiones, proporcionando ideas valiosas para cualquier persona involucrada en el diseño de sistemas o la optimización de procesos.', 'Daniel Kahneman', '2011-10-25');
INSERT INTO tb_libro VALUES(null, 1, 12, 'The Design of Everyday Things', 'Un clásico en diseño de interacción y usabilidad, que explora cómo los objetos cotidianos están diseñados y cómo podrían mejorarse para facilitar una mejor experiencia de usuario.', 'Don Norman', '1988-00-00');
INSERT INTO tb_libro VALUES(null, 1, 12, 'Introduction to Algorithms', 'Conocido como CLRS, este libro es una referencia estándar en el estudio de algoritmos y estructuras de datos en la informática y la ingeniería de software.', 'Thomas H. Cormen, Charles E. Leiserson y varios', '1989-00-00');


DELETE FROM tb_usuario;
/*
Estados:
Activo, Desactivado, Penalizado

*/

INSERT INTO tb_usuario VALUES(52336803, 0, '123456', 'Activo');
INSERT INTO tb_usuario VALUES(74588241, 0, 'abcdef', 'Activo');
INSERT INTO tb_usuario VALUES(53123564, 1, 'emp24*', 'Activo');
INSERT INTO tb_usuario VALUES(87654321, 0, '123', 'Activo');
INSERT INTO tb_usuario VALUES(12345678, 0, '123', 'Activo');
INSERT INTO tb_usuario VALUES(77889933, 0, '123', 'Activo');

INSERT INTO tb_prestamo VALUES(null, 52336803, 100, '2024-04-15', '17:32 PM', '2024-04-30', '17:32 PM', 'Finalizado');
INSERT INTO tb_prestamo VALUES(null, 53123564, 101, '2024-06-18', '16:47 PM', '2024-06-25', '16:47 PM', 'En curso');
INSERT INTO tb_prestamo VALUES(null, 74588241, 102, '2024-06-10', '9:30 AM', '2024-06-16', '9:30 AM', 'Pendiente devolucion');

INSERT INTO tb_prestamo VALUES(null, 87654321, 103, '2024-05-10', '9:13 AM', '2024-05-17', '9:13 AM', 'Finalizado');
INSERT INTO tb_prestamo VALUES(null, 12345678, 104, '2024-05-20', '15:40 PM', '2024-05-27', '15:40 PM', 'Finalizado');
INSERT INTO tb_prestamo VALUES(null, 77889933, 105, '2024-06-01', '10:58 AM', '2024-06-08', '10:58 AM', 'Finalizado');

INSERT INTO tb_sancion VALUES(null, 87654321, 5, '2024-05-22', '2024-05-27', "Entrega de libro fuera de plazo", "Activo");
INSERT INTO tb_sancion VALUES(null, 12345678, 3, '2024-05-30', '2024-06-02', "Entrega de libro fuera de plazo", "Activo");
INSERT INTO tb_sancion VALUES(null, 77889933, 1, '2024-06-09', '2024-06-10', "Entrega de libro fuera de plazo", "Inactivo");
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
