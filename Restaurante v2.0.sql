-- drop database restauranteGPS;
create database restauranteGPS;
use restauranteGPS;

create table Ciudad(
	nombre varchar(40),
    provincia varchar(40),
    constraint pk_ciudad primary key (nombre,provincia)
);

create table Restaurante(
	id_restaurante varchar(7),
    nombre varchar(40) not null,
    constraint pk_restaurante primary key (id_restaurante)
);

create table Sucursal(
	id_sucursal varchar(7),
    nombre varchar(40) not null,
    ciudad varchar(40) not null,
    estado varchar(40) not null,
    direccion varchar(40) not null,
    h_apertura varchar(10) not null,
    h_cierre varchar(10) not null,
    telefono varchar(10) not null,
    id_restaurante varchar(7),
    constraint pk_sucursal primary key (id_sucursal),
    constraint fk_restaurante foreign key (id_restaurante) references Restaurante(id_restaurante) on delete cascade on update cascade,
    constraint fk_ciudad foreign key (ciudad, estado) references Ciudad(nombre, provincia) on delete cascade on update cascade
);

create table Platillo(
	id_platillo varchar(7),
    nombre varchar(40) not null,
    descripcion varchar(200) not null,
    precio float(5,2) not null,
    fotografia varchar(40) not null,
    constraint pk_platillo primary key (id_platillo)
);

create table Tiene(
	id_platillo varchar(7),
    id_sucursal varchar(7),
    constraint pk_tiene primary key (id_platillo,id_sucursal),
    constraint fk_platillo foreign key (id_platillo) references Platillo(id_platillo) on delete cascade on update cascade,
    constraint fk_sucursal1 foreign key (id_sucursal) references Sucursal(id_sucursal) on delete cascade on update cascade
);

create table Empleado(
	id_empleado	varchar(7),
    nombre varchar(40) not null,
    contrasena varchar(10) not null,
    correo varchar(40) not null,
    telefono varchar(10) not null,
    id_sucursal varchar(7) not null,
    constraint pk_trabajador primary key(id_empleado),
    constraint fk_sucursal2 foreign key(id_sucursal) references Sucursal(id_sucursal) on delete cascade on update cascade
);

create table Usuario(
	id_usuario varchar(7),
    nombre varchar(40) not null,
    correo varchar(40) not null,
    contrasena varchar(10) not null,
    telefono varchar(10) not null,
    num_tarjeta varchar(16) not null,
    mes_vencimiento int(2) not null,
    anio_vencimiento int(2) not null,
    cvv int(3) not null,
    titular varchar(40) not null,
    constraint pk_usuario primary key(id_usuario)
);

create table Resena(
	id_platillo varchar(7),
    id_usuario varchar(7),
    calificacion varchar(1) not null,
    comentario varchar(200) not null,
    constraint pk_resena primary key (id_platillo, id_usuario),
    constraint fk_platillo2 foreign key (id_platillo) references Platillo(id_platillo) on delete cascade on update cascade,
    constraint fk_usuario foreign key (id_usuario) references Usuario(id_usuario) on delete cascade on update cascade
);

create table Orden(
	id_orden varchar(7),
    id_sucursal varchar(7) not null,
    fecha date not null,
    num_mesa varchar(2) not null,
    total float(5,2) not null,
    estatus varchar(10),
    id_usuario varchar(7),
    constraint pk_orden primary key (id_orden),
    constraint fk_sucursal3 foreign key (id_sucursal) references Sucursal(id_sucursal) on delete cascade on update cascade,
    constraint fk_usuario2 foreign key (id_usuario) references Usuario(id_usuario) on delete cascade on update cascade
);

create table Pedido(
	id_orden varchar(7),
    id_platillo varchar(7),
    nota varchar(200) not null,
    estatus varchar(20) not null,
    constraint pk_pedido primary key (id_orden,id_platillo),
    constraint fk_orden foreign key (id_orden) references Orden(id_orden) on delete cascade on update cascade,
    constraint fk_platillo3 foreign key (id_platillo) references Platillo(id_platillo) on delete cascade on update cascade
);

create table Administrador(
	usuario varchar(7),
    contrasena varchar(10) not null,
    correo varchar(40) not null,
    id_restaurante varchar(7) not null,
    telefono varchar(10) not null,
    constraint pk_admin primary key (usuario),
    constraint fk_restaurante4 foreign key (id_restaurante) references Restaurante(id_restaurante) on delete cascade on update cascade
);

-- Insertar Ciudades
insert into Ciudad (nombre, provincia) values ("Tampico","Tamaulipas"),
											  ("Ciudad Madero","Tamaulipas"),
                                              ("Altamira","Tamaulipas"),
                                              ("Monterrey","Nuevo Leon"),
                                              ("Merida","Yucatan"),
                                              ("Hermosillo","Sonora"),
                                              ("Saltillo","Coahuila"),
                                              ("Guadalajara","Jalisco");

-- Insertar Restaurantes
insert into Restaurante (id_restaurante, nombre) values ("res0001","Church Chicken"),
														("res0002","Little Caesars"),
                                                        ("res0003","IHOP"),
                                                        ("res0004","Ke-Alitas"),
                                                        ("res0005","Carls Jr.");
-- Insertar Sucursales
insert into Sucursal (id_sucursal, nombre, ciudad, estado, direccion, h_apertura, h_cierre, telefono, id_restaurante) values
			("suc0001","Av. Las Americas","Tampico","Tamaulipas","Avenida Las Americas 402","7:00","21:00","1234567","res0001"),
            ("suc0002","Petrolera","Tampico","Tamaulipas","Fermentum 2255","7:00","21:00","3488179","res0001"),
            ("suc0003","Cañada","Ciudad Madero","Tamaulipas","Velit 5399","7:00","21:00","7017196","res0001"),

            ("suc0004","Av. Hidalgo","Altamira","Tamaulipas","Avenida Hidalgo 1227","7:00","21:00","2219188","res0002"),
            ("suc0005","Flamboyanes","Ciudad Madero","Tamaulipas","Flamboyanes 6544","7:00","21:00","1728503","res0002"),
            ("suc0006","Plaza Galerias","Merida","Yucatan","Independencia 3575","7:00","21:00","4770905","res0002"),

            ("suc0007","Miramar","Tampico","Tamaulipas","Miguel Hidalgo 5432","7:00","21:00","8588348","res0003"),
            ("suc0008","Av. Rodolfo Torres","Monterrey","Nuevo Leon","Avenida Rodolfo Torres 5132","7:00","21:00","3116214","res0003"),
            ("suc0009","Av. Francisco I. Madero","Hermosillo","Sonora","Avenida Francisco I. Madero 8765","7:00","21:00","4651358","res0003"),

            ("suc0010","Plaza Torreon","Monterrey","Nuevo Leon","Convallis 2564","7:00","21:00","5221652","res0004"),
            ("suc0011","Macro Plaza","Saltillo","Coahuila","Avenida Aurelio Hernandez 6542","7:00","21:00","5648415","res0004"),
            ("suc0012","Col. Nautica","Guadalajara","Jalisco","Venustiano Carranza 3291","7:00","21:00","1968525","res0004"),

            ("suc0013","Saltillo Centro","Saltillo","Coahuila","Pino Suarez 8762","7:00","21:00","1749374","res0005"),
            ("suc0014","Monterrey Centro","Monterrey","Nuevo Leon","Reforma 3426","7:00","21:00","6268285","res0005"),
            ("suc0015","Merida Centro","Merida","Yucatan","Aldama 5348","7:00","21:00","4984198","res0005");

insert into Platillo (id_platillo, nombre, descripcion, precio, fotografia) values
			("pla0001","Paquete 14 Fajitas","Plaquete de 14 fajitas de pollo",169.50,"14fajitas.jpg"),
            ("pla0002","Paquete 10 Piezas","Plaquete de 10 piezas de pollo",140.00,"10pollo.jpg"),
            ("pla0003","Hamburguesa de Pollo","Deliciosa hamburguesa de pollo empanizado",89.90,"hamburguesapollo.jpg"),

            ("pla0004","Pizza de Peperonni","Pizza clasica de Peperonni con queso mozarella",79.90,"pizzapeperonni.jpg"),
            ("pla0005","Pizza Hawaiana","Pizza cubiera con piña, jamon y queso mozarella",139.00,"pizzahawaiana.jpg"),
            ("pla0006","Paquete Fiesta","2 Pizzas de Peperonni, palillos de ajo y refreso de 2 lts.",180.00,"paquetefiesta.jpg"),

            ("pla0007","Crepa New York","Crepa dulce con fresas, platano y queso crema",120.00,"crepaNW.jpg"),
            ("pla0008","Omelette California","Omelette de huevo batido con queso, jamon, pimientos y cebolla",120.00,"omeletteCalifornia.jpg"),
            ("pla0009","Hot Cakes IHOP","Hot Cakes naturales con mantequilla",69.90,"hotcakesIHOP.jpg"),

            ("pla0010","Litro de Alitas","Litro de Alitas de pollo y verduras, salsa a escoger",100.00,"litroalitas.jpg"),
            ("pla0011","Litro de Boneless","Litro de Boneless de pollo y verduras, salsa a escoger",100.00,"litroboneless.jpg"),
            ("pla0012","Paquete Estudiante","Litro de Boneless o Alitas, verdura y una orden de papas",150.00,"paqueteestudiante.jpg"),

            ("pla0013","Hamburguesa Carls","Hamburguesa de Res con queso, lechuga, tomate y cebolla",99.00,"hamburguesacarls.jpg"),
            ("pla0014","Hamburguesa Portobello","Hamburguesa de Res con queso manchego, champiñones, verdura y salsa secreta",169.50,"hamburguesaportobello.jpg"),
            ("pla0015","Hamburguesa Western Baccon","Hamburguesa de Res con queso amarillo, aros de cebolla, tocino y salsa de chipotle",169.50,"hamburguesawesternb.jpg");

insert into Tiene (id_platillo, id_sucursal) values ("pla0001","suc0001"),
													("pla0001","suc0002"),
                                                    ("pla0001","suc0003"),
                                                    ("pla0002","suc0001"),
                                                    ("pla0002","suc0002"),
                                                    ("pla0002","suc0003"),
                                                    ("pla0003","suc0003"),

                                                    ("pla0004","suc0004"),
                                                    ("pla0004","suc0005"),
                                                    ("pla0004","suc0006"),
                                                    ("pla0005","suc0004"),
                                                    ("pla0005","suc0005"),
                                                    ("pla0005","suc0006"),
                                                    ("pla0006","suc0006"),

                                                    ("pla0007","suc0007"),
                                                    ("pla0007","suc0008"),
                                                    ("pla0007","suc0009"),
                                                    ("pla0008","suc0007"),
                                                    ("pla0008","suc0008"),
                                                    ("pla0008","suc0009"),
                                                    ("pla0009","suc0009"),

                                                    ("pla0010","suc0010"),
                                                    ("pla0010","suc0011"),
                                                    ("pla0010","suc0012"),
                                                    ("pla0011","suc0010"),
                                                    ("pla0011","suc0011"),
                                                    ("pla0011","suc0012"),
                                                    ("pla0012","suc0012"),

                                                    ("pla0013","suc0013"),
                                                    ("pla0013","suc0014"),
                                                    ("pla0013","suc0015"),
                                                    ("pla0014","suc0013"),
                                                    ("pla0014","suc0014"),
                                                    ("pla0014","suc0015"),
                                                    ("pla0015","suc0015");

insert into Empleado (id_empleado, nombre, contrasena, correo, telefono, id_sucursal) values
			("emp0001","Cain Mckee","contrasena","empleado0001@gmail.com","5463218","suc0001"),
            ("emp0002","Aquila Reed","contrasena","empleado0002@gmail.com","2132896","suc0001"),
            ("emp0003","Hector Solomon","contrasena","empleado0003@gmail.com","5128634","suc0002"),
            ("emp0004","Ongo Gaboglian","contrasena","empleado0004@gmail.com","5437845","suc0002"),
            ("emp0005","Martin Banks","contrasena","empleado0005@gmail.com","3218904","suc0003"),
            ("emp0006","Emery Dawson","contrasena","empleado0006@gmail.com","3429063","suc0003"),

            ("emp0007","Mantis Tobogan","contrasena","empleado0007@gmail.com","1290458","suc0004"),
            ("emp0008","Josiah Powell","contrasena","empleado0008@gmail.com","9034559","suc0004"),
            ("emp0009","Addison Fleming","contrasena","empleado0009@gmail.com","6578129","suc0005"),
            ("emp0010","Darius Anthony","contrasena","empleado0010@gmail.com","3217985","suc0005"),
            ("emp0011","Simon Brock","contrasena","empleado0011@gmail.com","2116213","suc0006"),
            ("emp0012","Elvis Teck","contrasena","empleado0012@gmail.com","9023484","suc0006"),

            ("emp0013","Nathaniel Howe","contrasena","empleado0013@gmail.com","5642876","suc0007"),
            ("emp0014","Curran Mcpherson","contrasena","empleado0014@gmail.com","3548672","suc0007"),
            ("emp0015","Steven Kelly","contrasena","empleado0015@gmail.com","1325497","suc0008"),
            ("emp0016","Kadeem Kennedy","contrasena","empleado0016@gmail.com","5237693","suc0008"),
            ("emp0017","Jose Elliott","contrasena","empleado0017@gmail.com","6758045","suc0009"),
            ("emp0018","Calvin Campbell","contrasena","empleado0018@gmail.com","2356799","suc0009"),

            ("emp0019","William Marshall","contrasena","empleado0019@gmail.com","2315685","suc0010"),
            ("emp0020","Cole Horton","contrasena","empleado0020@gmail.com","6445824","suc0010"),
            ("emp0021","Karen Garcia","contrasena","empleado0021@gmail.com","3425672","suc0011"),
            ("emp0022","Leslie Briones","contrasena","empleado0022@gmail.com","3425867","suc0011"),
            ("emp0023","Kevin Villanueva","contrasena","empleado0023@gmail.com","6873540","suc0012"),
            ("emp0024","Grecia Cruz","contrasena","empleado0024@gmail.com","5348792","suc0012"),

            ("emp0025","Victor Godinez","contrasena","empleado0025@gmail.com","3452879","suc0013"),
            ("emp0026","Manuel Hernandez","contrasena","empleado0026@gmail.com","5364870","suc0013"),
            ("emp0027","Jose Bronco","contrasena","empleado0027@gmail.com","2342890","suc0014"),
            ("emp0028","Luis Rodriguez","contrasena","empleado0028@gmail.com","3871253","suc0014"),
            ("emp0029","Marco Fernandez","contrasena","empleado0029@gmail.com","3687249","suc0015"),
            ("emp0030","Carlos Castillo","contrasena","empleado0030@gmail.com","3214564","suc0015");

insert into Usuario (id_usuario, nombre, correo, contrasena, telefono, num_tarjeta, mes_vencimiento, anio_vencimiento, cvv, titular) values
			("usu0001","Arthur Clemente","usuario0001@gmail.com","contrasena","3218946","4027664103568942","12","22","452","Arhur Clemente"),
            ("usu0002","Maria Acosta","usuario0002@gmail.com","contrasena","9551235","4027664178451206","10","20","367","Maria Acosta"),
            ("usu0003","Andrea Azua","usuario0003@gmail.com","contrasena","7556541","4027664114401598","08","21","794","Andrea Azua"),
            ("usu0004","Brigitte Fuentes","usuario0004@gmail.com","contrasena","3567842","4027664131024895","11","22","169","Brigitte Fuentes"),
            ("usu0005","Carlos Ottino","usuario0005@gmail.com","contrasena","6941258","4027664114963572","09","20","157","Carlos Ottino");

insert into Administrador (usuario, contrasena, correo, id_restaurante, telefono) values
			("adm0001","root0001","alanzamora@gmail.com","res0001","4598631"),
            ("adm0002","root0002","anacavazos@gmail.com","res0002","2134874"),
            ("adm0003","root0003","ricardogtz@gmail.com","res0003","8754120"),
            ("adm0004","root0004","josemiguel@gmail.com","res0004","1598364"),
            ("adm0005","root0005","andresgraciano@gmail.com","res0005","4024581");

insert into Orden (id_orden, id_sucursal, fecha, num_mesa, total, estatus, id_usuario) values
            ("ord0001","suc0006","2018-04-25","9",169.50,"Aprobada","usu0001"),
            ("ord0002","suc0005","2018-04-26","9",70.50,"Aprobada","usu0001");

insert into Pedido (id_orden, id_platillo, nota, estatus) values
            ("ord0001","pla0004","Sin mucho picante","Aprobada"),
            ("ord0001","pla0005","Sin mucho cinco","Aprobada");

-- drop function RevisarLogin;
delimiter $$
create function RevisarLogin(id varchar(7), contra varchar(10)) returns varchar(20)
begin
    declare respuesta varchar(20);
    if (id='root' and contra='root') then
        set respuesta="administradorG";
    elseif not exists(select * from Administrador where usuario=id and contrasena=contra) then
        if not exists(select * from Empleado where id_empleado=id and contrasena=contra) then
            if not exists(select * from Usuario where id_usuario=id and contrasena=contra) then
				set respuesta=0;
			else
				set respuesta="cliente";
			end if;
		else
			set respuesta="empleado";
        end if;
    else
        set respuesta="administradorR";
    end if;
    return respuesta;
end$$

-- call ObtenerRestaurante("adm0002");
delimiter $$
create procedure ObtenerRestaurante(in id varchar(7))
begin
    select id_restaurante from Administrador where usuario=id;
end$$

-- select RevisarLogin("adm0001","root0001");

-- ============================================= Son todos los Select (Estan por orden) =============================================

-- Inicia Stored Procedures exclusivos de Empleado
DROP PROCEDURE IF EXISTS getPlatillos;
DELIMITER $$
CREATE PROCEDURE getPlatillos(IN idEmpleado VARCHAR(10))
BEGIN
	DECLARE laSucursal VARCHAR(100);
    SELECT id_sucursal INTO laSucursal FROM empleado WHERE id_empleado=idEmpleado;

    SELECT platillo.nombre, descripcion, precio, fotografia FROM platillo JOIN tiene JOIN empleado
    WHERE platillo.id_platillo = tiene.id_platillo
    AND tiene.id_sucursal=laSucursal
    AND empleado.id_sucursal=tiene.id_sucursal
    AND empleado.id_empleado=idEmpleado;
END$$
-- Fin de SP Empleado

-- call VerCiudad();
delimiter $$
create procedure VerCiudad()
begin
 	Select * from Ciudad
    order by pronvincia asc;
end$$

-- call VerRestaurante();
delimiter $$
create procedure VerRestaurante()
begin
  	Select * from Restaurante;
end$$

-- call VerSucursal();
delimiter $$
create procedure VerSucursal()
begin
  	Select * from Sucursal;
end$$

-- call VerSucursalRestaurante("adm0001");
delimiter $$
create procedure VerSucursalRestaurante(in idAdmin varchar(7))
begin
  	Select *
  	from Sucursal
  	where id_restaurante in (select id_restaurante from Administrador where usuario=idAdmin)
  	Order by nombre;
end$$

-- call VerSucursalEspecifica("suc0002");
delimiter $$
create procedure VerSucursalEspecifica(in sucursal varchar(7))
begin
  	Select nombre, ciudad, estado, direccion, estado, h_apertura, h_cierre, telefono
  	from Sucursal
  	where id_sucursal=sucursal;
end$$

-- call VerPlatillo();
delimiter $$
create procedure VerPlatillo()
begin
  	Select * from Platillo;
end$$

-- call VerTiene();
delimiter $$
create procedure VerTiene()
begin
  	Select * from Tiene;
end$$

-- call VerTieneSucursal("suc0002");
delimiter $$
create procedure VerTieneSucursal(in sucursal varchar(7))
begin
  	Select Platillo.id_platillo, nombre, descripcion, precio, fotografia
  	from Platillo join Tiene
  	on Tiene.id_sucursal=sucursal and Platillo.id_platillo=Tiene.id_platillo
  	Order by Platillo.nombre;
end$$

-- call VerEmpleado();
delimiter $$
create procedure VerEmpleado()
begin
  	Select * from Empleado;
end$$

-- drop procedure VerEmpleadoRestaurante;
-- call VerEmpleadoRestaurante("res0001");
delimiter $$
create procedure VerEmpleadoRestaurante(in restaurante varchar(7))
begin
  	Select Empleado.id_empleado, Empleado.nombre, Empleado.contrasena, Empleado.correo, Empleado.telefono, Restaurante.nombre as nomRestaurante, Sucursal.nombre as nomSucursal
  	from Empleado join Sucursal join Restaurante
  	on Empleado.id_sucursal=Sucursal.id_sucursal and Sucursal.id_restaurante=Restaurante.id_restaurante and Restaurante.id_restaurante=restaurante;
end$$

-- call VerEmpleadoSucursal("suc0001");
delimiter $$
create procedure VerEmpleadoSucursal(in sucursal varchar(7))
begin
  	Select nombre, correo, telefono
  	from Empleado
  	where id_sucursal=sucursal
  	Order by nombre;
end$$

-- call VerUsuario();
delimiter $$
create procedure VerUsuario()
begin
  	Select * from Usuario;
end$$

-- call VerUsuarioEspecifico("usu0002");
delimiter $$
create procedure VerUsuarioEspecifico(in usuario varchar(7))
begin
  	Select * from Usuario
  	where id_usuario=usuario;
end$$

-- call VerResena();
delimiter $$
create procedure VerResena()
begin
  	Select Resena.id_platillo, Resena.id_usuario, Platillo.nombre, Usuario.nombre, calificacion, comentario
  	from Platillo join Usuario join Resena
  	on Resena.id_platillo=Platillo.id_platillo and Resena.id_usuario=Usuario.id_usuario
  	Order by Platillo.nombre;
end$$

-- call VerResenaPlatillo("pla0001");
delimiter $$
create procedure VerResenaPlatillo(in platillo varchar(7))
begin
  	Select Platillo.nombre as platillo, Usuario.nombre as usuario, calificacion, comentario
  	from Platillo join Usuario join Resena
  	on Resena.id_platillo=Platillo.id_platillo and Resena.id_usuario=Usuario.id_usuario and Resena.id_platillo=platillo
  	Order by Platillo.nombre;
end$$

-- call VerResenaEspecifica("pla0001","usu0002");
delimiter $$
create procedure VerResenaEspecifica(in platillo varchar(7), usuario varchar(7))
begin
  	Select Platillo.nombre as platillo, Usuario.nombre as usuario, calificacion, comentario
  	from Platillo join Usuario join Resena
  	on Resena.id_platillo=Platillo.id_platillo and Resena.id_usuario=Usuario.id_usuario and Resena.id_platillo=platillo and Resena.id_usuario=usuario
  	Order by Platillo.nombre;
end$$

-- call VerOrden();
delimiter $$
create procedure VerOrden()
begin
  	Select * from Orden
  	Order by fecha;
end$$

-- call VerOrdenSucursal("suc0001");
delimiter $$
create procedure VerOrdenSucursal(in sucursal varchar(7))
begin
  	Select * from Orden where id_sucursal=sucursal
  	Order by fecha;
end$$

-- call VerOrdenUsuario("usu0002");
delimiter $$
create procedure VerOrdenUsuario(in usuario varchar(7))
begin
  	Select Orden.id_orden, Orden.id_sucursal, Sucursal.nombre, Orden.fecha, Orden.num_mesa, Orden.total, Orden.estatus
    from Orden join Sucursal
    on Orden.id_sucursal=Sucursal.id_sucursal and Orden.id_usuario=usuario
  	Order by fecha;
end$$

-- call VerPedido();
delimiter $$
create procedure VerPedido()
begin
  	Select * from Pedido;
end$$

-- call VerPedidoOrden("ord0001");
delimiter $$
create procedure VerPedidoOrden(in orden varchar(7))
begin
  	Select Pedido.id_orden, Pedido.id_platillo, Platillo.nombre, Pedido.nota, Pedido.estatus
  	from Pedido join Platillo
  	on Pedido.id_platillo=Platillo.id_platillo and Pedido.id_orden=orden;
end$$

-- call VerPedidoEspecifico("ord0001","pla0001");
delimiter $$
create procedure VerPedidoEspecifico(in orden varchar(7), platillo varchar(7))
begin
  	Select id_orden, Platillo.nombre as nombrePlatillo, nota, estatus
  	from Pedido join Platillo
  	on Pedido.id_platillo=Platillo.id_platillo and Pedido.id_orden=orden and Pedido.id_platillo=platillo;
end$$

-- call VerAdministrador();
delimiter $$
create procedure VerAdministrador()
begin
  	Select * from Administrador;
end$$

-- drop procedure VerAdministradorRestaurante;
-- call VerAdministradorRestaurante("res0001");
delimiter $$
create procedure VerAdministradorRestaurante(in restaurante varchar(7))
begin
  	Select usuario, correo, Restaurante.nombre as nombreRestaurante, telefono
  	from Administrador join Restaurante
  	on Administrador.id_restaurante=Restaurante.id_restaurante and Administrador.id_restaurante=restaurante;
end$$

-- ============================================= Son todos los Delete (Estan por orden) =============================================
-- call EliminarCiudad("Tampico","Tamaulipas");
delimiter $$
create procedure EliminarCiudad(in nomb varchar(40), provin varchar(40))
begin
	Delete from Ciudad where nombre=nomb and provincia=provin;
end$$

-- call EliminarRestaurante("res1236");
delimiter $$
create procedure EliminarRestaurante(in restaurante varchar(7))
begin
	Delete from Restaurante where id_restaurante=restaurante;
end$$

-- call EliminarSucursal("");
delimiter $$
create procedure EliminarSucursal(in sucursal varchar(7))
begin
	Delete from Sucursal where id_sucursal=sucursal;
end$$

-- call EliminarPlatillo("pla1235");
delimiter $$
create procedure EliminarPlatillo(in platillo varchar(7))
begin
	Delete from Platillo where id_platillo=platillo;
end$$

-- call EliminarTiene("pla1234","res1234");
delimiter $$
create procedure EliminarTiene(in platillo varchar(7), sucursal varchar(7))
begin
	Delete from Tiene where id_platillo=platillo and id_sucursal=sucursal;
end$$

-- call EliminarEmpleado("emp1236");
delimiter $$
create procedure EliminarEmpleado(in empleado varchar(7))
begin
	Delete from Empleado where id_empleado=empleado;
end$$

-- call EliminarUsuario("usu1235");
delimiter $$
create procedure EliminarUsuario(in usuario varchar(7))
begin
	Delete from Usuario where id_usuario=usuario;
end$$

-- call EliminarResena("pla1234","usu1235");
delimiter $$
create procedure EliminarResena(in platillo varchar(7), usuario varchar(7))
begin
	Delete from Resena where id_platillo=platillo and id_usuario=usuario;
end$$

-- call EliminarOrden("ord1239");
delimiter $$
create procedure EliminarOrden(in orden varchar(7))
begin
	Delete from Orden where id_orden=orden;
end$$

-- call EliminarPedido("ord1239","pla1234");
delimiter $$
create procedure EliminarPedido(in orden varchar(7), platillo varchar(7))
begin
	Delete from Pedido where id_orden=orden and id_platillo=platillo;
end$$

select * from Administrador;
-- call EliminarAdministrador("adm1235");
delimiter $$
create procedure EliminarAdministrador(in usuA varchar(7))
begin
	Delete from Administrador where usuario=usuA;
end$$

-- ============================================= Son todos los Insert (Estan por orden) =============================================
-- select InsertarCiudad("Madero","Tamaulipas");
delimiter $$
create function InsertarCiudad(nombreCd varchar(40), nomProvincia varchar(40)) returns varchar(4)
begin
  declare respuesta varchar(4);
  if not exists(select * from Ciudad where nombre=nombreCd and provincia=nomProvincia) then
	insert into Ciudad values(nombreCd,nomProvincia);
    set respuesta=1; -- Insercion Exitosa en Ciudad
else
	set respuesta=0; -- Esa combinacion de ciudad y provincia ya existe
end if;
    return respuesta;
end$$

-- select InsertarRestaurante("res1234","Restaurante Las Americas","Tampico","Tamaulipas","Av. Las Americas 1245","7:00 AM","20:00PM","833123567");
delimiter $$
create function InsertarRestaurante(restaurante varchar(7), nombreR varchar(40)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Restaurante where id_restaurante=restaurante) then
		insert into Restaurante values(restaurante, nombreR);
		set respuesta=1; -- Insercion exitosa en Restaurante
	else
		set respuesta=0; -- Ya existe ese Restaurante
	end if;
    return respuesta;
end$$

-- drop function InsertarSucursal;
delimiter $$
create function InsertarSucursal(sucursal varchar(7), nombreS varchar(40), ciudadS varchar(40), estadoS varchar(40),
				direccionS varchar(40), aperturaS varchar(10), cierreS varchar(10), telefonoS varchar(10), restaurante varchar(7)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Sucursal where id_sucursal=sucursal) then
		if exists(select * from Restaurante where id_restaurante=restaurante) then
			if exists(select * from Ciudad where nombre=ciudadS and provincia=estadoS) then
				insert into Sucursal values(sucursal, nombreS, ciudadS, estadoS, direccionS, aperturaS, cierreS, telefonoS, restaurante);
				set respuesta=1; -- Insercion exitosa en Restaurante
			else
				set respuesta=2; -- No existe esa combinacion de Ciudad y Provincia
			end if;
		else
			set respuesta=3; -- No existe el Restaurante
		end if;
	else
		set respuesta=0; -- Ya existe ese Sucursal
	end if;
    return respuesta;
end$$

-- select InsertarPlatillo("pla1235","Alitas Hot","Alitas de Pollo con una salsa Habanero",169.00,"/imagenes/alitashot.jpg");
delimiter $$
create function InsertarPlatillo(platillo varchar(7), nombreP varchar(40), descP varchar(200), precioP float(5,2), fotoP varchar(40)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Platillo where id_platillo=platillo) then
		insert into Platillo values(platillo, nombreP, descP, precioP, fotoP);
		set respuesta=1; -- Insercion exitosa en Platillo
	else
		set respuesta=0; -- Ya existe ese Platillo
	end if;
    return respuesta;
end$$

-- drop function InsertarTiene;
-- select InsertarTiene("pla1234","res1235");
delimiter $$
create function InsertarTiene(platillo varchar(7), sucursal varchar(7)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Tiene where id_platillo=platillo and id_sucursal=sucursal) then
		if exists(select * from Platillo where id_platillo=platillo) then
			if exists(select * from Sucursal where id_sucursal=sucursal) then
				insert into Tiene values(platillo, sucursal);
				set respuesta=1; -- Insercion exitosa en Tiene
            else
             set respuesta=2; -- No existe esa sucursal
			end if;
        else
		 set respuesta=3; -- No existe ese platillo
		end if;
	else
		set respuesta=0; -- Ya existe ese relacion de Platillo y Sucursal
	end if;
    return respuesta;
end$$

-- drop function InsertarEmpleado
-- select InsertarEmpleado("emp1236","Alan Zamora Barrera","contra1234","alanzamora@gmail.com","8331234567","res1235");
delimiter $$
create function InsertarEmpleado(emp varchar(7), nombreE varchar(40), contra varchar(10), correoE varchar(40), telefonoE varchar(10), sucurE varchar(7))
								returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Empleado where id_empleado=emp) then
		if exists(select * from Sucursal where id_sucursal=sucurE) then
			insert into Empleado values(emp, nombreE, contra, correoE, telefonoE, sucurE);
			set respuesta=1; -- Insercion exitosa en Empleado
		else
			set respuesta=2; -- No existe esa Sucursal
		end if;
	else
		set respuesta=0; -- Ya existe ese Empleado
	end if;
    return respuesta;
end$$

-- select InsertarUsuario("usu1235","Ana Cavazos Argot","anaowo@gmail.com","anaowo2","8331254976");
delimiter $$
create function InsertarUsuario(usuario varchar(7), nombreU varchar(40), correoU varchar(40), contra varchar(10), teleU varchar(10), tarjetaU varchar(16),
								mesU int(2), anioU int(2), cvvU int(3), titularU varchar(40)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Usuario where id_usuario=usuario) then
		insert into Usuario values(usuario, nombreU, correoU, contra, teleU, tarjetaU, mesU, anioU, cvvU, titularU);
		set respuesta=1; -- Insercion exitosa en Usuario
	else
		set respuesta=0; -- Ya existe ese Usuario
	end if;
    return respuesta;
end$$

-- drop function InsertarResena;
-- select InsertarResena("pla1234","usu1235","4","Traia pelos las Alitas");
delimiter $$
create function InsertarResena(platillo varchar(7), usuario varchar(7), calif varchar(1), coment varchar(200)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Resena where id_platillo=platillo and id_usuario=usuario) then
		if exists(select * from Platillo where id_platillo=platillo) then
			if exists(select * from Usuario where id_usuario=usuario) then
				insert into Resena values(platillo, usuario, calif, coment);
				set respuesta=1; -- Insercion exitosa en Resena
            else
             set respuesta=2; -- No existe ese Usuario
			end if;
        else
		 set respuesta=3; -- No existe ese platillo
		end if;
	else
		set respuesta=0; -- Ya existe ese relacion de Platillo y Usuario
	end if;
    return respuesta;
end$$

-- select InsertarOrden("ord1239","res1235","9",169.50,"Aprobada","usu1235");
-- select * from Orden;
delimiter $$
create function InsertarOrden(orden varchar(7), sucurO varchar(7), fechaO date, mesa varchar(2), total float(5,2), estatus varchar(10), usuario varchar(7)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Orden where id_orden=orden) then
		if exists(select * from Sucursal where id_sucursal=sucurO) then
			if exists(select * from Usuario where id_usuario=usuario) then
				insert into Orden values(orden, sucurO, fechaO, mesa, total, estatus, usuario);
				set respuesta=1; -- Insercion exitosa en Orden
            else
             set respuesta=2; -- No existe ese Usuario
			end if;
        else
		 set respuesta=3; -- No existe esa Sucursal
		end if;
	else
		set respuesta=0; -- Ya existe esa Orden
	end if;
    return respuesta;
end$$

-- drop function InsertarPedido;
-- select InsertarPedido("ord1239","pla1234","Sin apio porque wacala de perro","Procesada");
-- select * from Pedido;
delimiter $$
create function InsertarPedido(orden varchar(7), platillo varchar(7), notaP varchar(200), estatusP varchar(20)) returns varchar(4)
begin
	declare respuesta varchar(4);
	if not exists(select * from Pedido where id_orden=orden and id_platillo=platillo) then
		if exists(select * from Orden where id_orden=orden) then
			if exists(select * from Platillo where id_platillo=platillo) then
				insert into Pedido values(orden, platillo, notaP, estatusP);
				set respuesta=1; -- Insercion exitosa en Pedido
			else
				set respuesta=2; -- No existe ese Platillo
			end if;
		else
			set respuesta=3; -- No existe esa orden
		end if;
	else
		set respuesta=0; -- Ya existe esa combinacion de Orden y Platillo
	end if;
    return respuesta;
end$$

-- select InsertarAdministrador("adm1235","contra1234","alanzamora@gmail.com","res1235","8331234567");
-- drop function InsertarAdministrador;
delimiter $$
create function InsertarAdministrador(usuA varchar(7), contra varchar(10), correoA varchar(40), restA varchar(7), telefonoA varchar(10)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Administrador where usuario=usuA) then
		if exists(select * from Restaurante where id_restaurante=restA) then
			if not exists(select * from Administrador where id_restaurante=restA) then
				insert into Administrador values(usuA, contra, correoA, restA, telefonoA);
				set respuesta=1; -- Insercion exitosa en Empleado
			else
				set respuesta=2; -- Alguien ya es Administrador
			end if;
		else
			set respuesta=3; -- No existe ese Restaurante
		end if;
	else
		set respuesta=0; -- Ya existe ese Administrador
	end if;
    return respuesta;
end$$

-- ============================================= Son todos los Update (Estan por orden) =============================================
--

delimiter $$
create function ActualizarCiudad(nombreCd varchar(40), nomProvincia varchar(40), nombreAct varchar(40), provinciaAct varchar(40)) returns varchar(4)
begin
  	declare respuesta varchar(4);
  	if exists(select * from Ciudad where Ciudad.nombre=nombreCd and Ciudad.provincia=nomProvincia) then
  		if((nombreCd=nombreAct and nomProvincia=provinciaAct)
  			or not exists(select * from Ciudad where Ciudad.nombre=nombreAct and Ciudad.provincia=provinciaAct)) then
  			update Ciudad set Ciudad.nombre=nombreAct,
  							  Ciudad.provincia=provinciaAct
  			where Ciudad.nombre=nombreCd and Ciudad.provincia=nomProvincia;
  			set respuesta=1; -- Actualizacion Exitosa en Ciudad
  		else
  			set respuesta=2; -- La PK actualizada ya existe
  		end if;
  	else
  		set respuesta=0; -- No existe esa relacion de Ciudad y Provincia
  	end if;
    return respuesta;
end$$

--
delimiter $$
create function ActualizarRestaurante(restaurante varchar(7), restAct varchar(7), nombreAct varchar(40)) returns varchar(4)
begin
  	declare respuesta varchar(4);
  	if exists(select * from Restaurante where Restaurante.id_restaurante=restaurante) then
  		if(restaurante=restAct or not exists(select * from Restaurante where Restaurante.id_restaurante=restAct)) then
  			update Restaurante set Restaurante.id_restaurante=restAct,
  							  	   Restaurante.nombre=nombreAct
  			where Restaurante.id_restaurante=restaurante;
  			set respuesta=1; -- Actualizacion Exitosa en Restaurante
  		else
  			set respuesta=2; -- La PK actualizada ya existe
  		end if;
  	else
  		set respuesta=0; -- No existe ese Restaurante
  	end if;
    return respuesta;
end$$

--
delimiter $$
create function ActualizarSucursal(sucur varchar(7), sucurAct varchar(7), nombreAct varchar(40), ciudadAct varchar(40), provinciaAct varchar(40),
								   direccionAct varchar(40), aperturaAct varchar(10), cierreAct varchar(10), telefonoAct varchar(10),
								   restauranteAct varchar(7)) returns varchar(4)
begin
  	declare respuesta varchar(4);
  	if exists(select * from Sucursal where Sucursal.id_sucursal=sucur) then
  		if(sucur=sucurAct or not exists(select * from Sucursal where Sucursal.id_sucursal=sucurAct)) then
  			update Sucursal set Sucursal.id_sucursal=sucurAct,
  								Sucursal.nombre=nombreAct,
  								Sucursal.ciudad=ciudadAct,
  								Sucursal.estado=provinciaAct,
  								Sucursal.direccion=direccionAct,
  								Sucursal.h_apertura=aperturaAct,
  								Sucursal.h_cierre=cierreAct,
  								Sucursal.telefono=telefonoAct,
  								Sucursal.id_restaurante=restauranteAct
  			where Sucursal.id_sucursal=sucur;
  			set respuesta=1; -- Actualizacion Exitosa en Sucursal
  		else
  			set respuesta=2; -- La PK actualizada ya existe
  		end if;
  	else
  		set respuesta=0; -- No existe esa Sucursal
  	end if;
    return respuesta;
end$$

--
delimiter $$
create function ActualizarPlatillo(platillo varchar(7), platiAct varchar(7), nombreAct varchar(40), descripAct varchar(200),
								   precioAct float(5,2), fotoAct varchar(40)) returns varchar(4)
begin
  	declare respuesta varchar(4);
  	if exists(select * from Platillo where Platillo.id_platillo=platillo) then
  		if(platillo=platiAct or not exists(select * from Platillo where Platillo.id_platillo=platiAct)) then
  			update Platillo set Platillo.id_platillo=platiAct,
  								Platillo.nombre=nombreAct,
  								Platillo.descripcion=descripAct,
  								Platillo.precio=precioAct,
  								Platillo.fotografia=fotoAct
  			where Platillo.id_platillo=platillo;
  			set respuesta=1; -- Actualizacion Exitosa en Platillo
  		else
  			set respuesta=2; -- La PK actualizada ya existe
  		end if;
  	else
  		set respuesta=0; -- No existe ese Platillo
  	end if;
    return respuesta;
end$$

--
delimiter $$
create function ActualizarTiene(platillo varchar(7), sucursal varchar(7), platiAct varchar(7), sucurAct varchar(7)) returns varchar(4)
begin
  	declare respuesta varchar(4);
  	if exists(select * from Tiene where Tiene.id_platillo=platillo and Tiene.id_sucursal=sucursal) then
  		if((platillo=platiAct and sucursal=sucurAct) or not exists(select * from Tiene where Tiene.id_platillo=platiAct and Tiene.id_sucursal=sucurAct)) then
  			if exists(select * from Platillo where Platillo.id_platillo=platiAct) then
  				if exists(select * from Sucursal where Sucursal.id_sucursal=sucurAct) then
  					update Tiene set Tiene.id_platillo=platiAct,
				  					 Tiene.id_sucursal=sucurAct
					where Tiene.id_platillo=platillo and Tiene.id_sucursal=sucursal;
					set respuesta=1; -- Actualizacion Exitosa en Tiene
  				else
  					set respuesta=2; -- No existe esa Sucursal
  				end if;
  			else
  				set respuesta=3; -- No existe ese Platillo
			end if;
  		else
  			set respuesta=4; -- La PK actualizada ya existe
  		end if;
  	else
  		set respuesta=0; -- No existe esa relacion de Platillo y Sucursal
  	end if;
    return respuesta;
end$$

-- drop function ActualizarEmpleado
delimiter $$
create function ActualizarEmpleado(empleado varchar(7), empleadoAct varchar(7), nombreAct varchar(40), contraAct varchar(10), correoAct varchar(40),
								   telefonoAct varchar(10), sucurAct varchar(7)) returns varchar(4)
begin
  	declare respuesta varchar(4);
  	if exists(select * from Empleado where Empleado.id_empleado=empleado) then
  		if(empleado=empleadoAct or not exists(select * from Empleado where Empleado.id_empleado=empleadoAct)) then
  			if exists(select * from Sucursal where Sucursal.id_sucursal=sucurAct) then
  				update Empleado set Empleado.id_empleado=empleadoAct,
  									Empleado.nombre=nombreAct,
  									Empleado.contrasena=contraAct,
  									Empleado.correo=correoAct,
  									Empleado.telefono=telefonoAct,
  									Empleado.id_sucursal=sucurAct
  				where Empleado.id_empleado=empleado;
  				set respuesta=1; -- Actualizacion Exitosa en Empleado
  			else
  				set respuesta=2; -- No existe esa Sucursal
			end if;
  		else
  			set respuesta=3; -- La PK actualizada ya existe
  		end if;
  	else
  		set respuesta=0; -- No existe ese Empleado
  	end if;
    return respuesta;
end$$

--
delimiter $$
create function ActualizarUsuario(usuario varchar(7), usuarioAct varchar(7), nombreAct varchar(40), correoAct varchar(40),
								  contraAct varchar(10), telefonoAct varchar(10), tarjetaAct varchar(16), mesAct int(2), anioAct int(2),
								  cvvAct int(3), titularAct varchar(40)) returns varchar(4)
begin
  	declare respuesta varchar(4);
  	if exists(select * from Usuario where Usuario.id_usuario=usuario) then
  		if(usuario=usuarioAct or not exists(select * from Usuario where Usuario.id_usuario=usuarioAct)) then
  			update Usuario set Usuario.id_usuario=usuarioAct,
  							   Usuario.nombre=nombreAct,
  							   Usuario.correo=correoAct,
  							   Usuario.contrasena=contraAct,
  							   Usuario.telefono=telefonoAct,
  							   Usuario.num_tarjeta=tarjetaAct,
  							   Usuario.mes_vencimiento=mesAct,
  							   Usuario.anio_vencimiento=anioAct,
  							   Usuario.cvv=cvvAct,
  							   Usuario.titular=titularAct
  			where Usuario.id_usuario=usuario;
  			set respuesta=1; -- Actualizacion Exitosa en Usuario
  		else
  			set respuesta=2; -- La PK actualizada ya existe
  		end if;
  	else
  		set respuesta=0; -- No existe ese Usuario
  	end if;
    return respuesta;
end$$

--
delimiter $$
create function ActualizarResena(platillo varchar(7), usuario varchar(7), platiAct varchar(7), usuarioAct varchar(7),
								 califAct varchar(1), comentAct varchar(200)) returns varchar(4)
begin
  	declare respuesta varchar(4);
  	if exists(select * from Resena where Resena.id_platillo=platillo and Resena.id_usuario=usuario) then
  		if((platillo=platiAct and usuario=usuarioAct) or not exists(select * from Resena where Resena.id_platillo=platiAct and Resena.id_usuario=usuarioAct)) then
  			if exists(select * from Platillo where Platillo.id_platillo=platiAct) then
  				if exists(select * from Usuario where Usuario.id_usuario=usuarioAct) then
  					update Resena set Resena.id_platillo=platiAct,
  									  Resena.id_usuario=usuarioAct,
  									  Resena.calificacion=califAct,
  									  Resena.comentario=comentAct
  					where Resena.id_platillo=platillo and Resena.id_usuario=usuario;
  					set respuesta=1; -- Actualizacion Exitosa en Reseña
  				else
  					set respuesta=2; -- No existe ese Usuario
  				end if;
  			else
  				set respuesta=3; -- No existe ese Platillo
  			end if;
  		else
  			set respuesta=4; -- La PK actualizada ya existe
  		end if;
  	else
  		set respuesta=0; -- No existe esa Reseña
  	end if;
    return respuesta;
end$$

-- drop function ActualizarOrden
delimiter $$
create function ActualizarOrden(orden varchar(7), ordenAct varchar(7), sucurAct varchar(7), fechaAct date, mesaAct varchar(2),
								totalAct float(5,2), estatusAct varchar(10), usuarioAct varchar(7)) returns varchar(4)
begin
  	declare respuesta varchar(4);
  	if exists(select * from Orden where Orden.id_orden=orden) then
  		if(orden=ordenAct or not exists(select * from Orden where Orden.id_orden=ordenAct)) then
  			if exists(select * from Sucursal where Sucursal.id_sucursal=sucurAct) then
  				if exists(select * from Usuario where Usuario.id_usuario=usuarioAct) then
  					update Orden set Orden.id_orden=ordenAct,
  									 Orden.id_sucursal=sucurAct,
  									 Orden.fecha=fechaAct,
  									 Orden.num_mesa=mesaAct,
  									 Orden.total=totalAct,
  									 Orden.estatus=estatusAct,
  									 Orden.id_usuario=usuarioAct
  					where Orden.id_orden=orden;
  					set respuesta=1; -- Actualizacion Exitosa en Orden
  				else
  					set respuesta=2; -- No existe ese Usuario
  				end if;
  			else
  				set respuesta=3; -- No existe esa Sucursal
  			end if;
  		else
  			set respuesta=4; -- La PK actualizada ya existe
  		end if;
  	else
  		set respuesta=0; -- No existe esa Orden
  	end if;
    return respuesta;
end$$

--
delimiter $$
create function ActualizarPedido(orden varchar(7), platillo varchar(7), ordenAct varchar(7), platiAct varchar(7),
								 notaAct varchar(200), estatusAct varchar(20)) returns varchar(4)
begin
  	declare respuesta varchar(4);
  	if exists(select * from Pedido where Pedido.id_orden=orden and Pedido.id_platillo=platillo) then
  		if((orden=ordenAct and platillo=platiAct) or not exists(select * from Pedido where Pedido.id_orden=ordenAct and Pedido.id_platillo=platiAct)) then
  			if exists(select * from Orden where Orden.id_orden=ordenAct) then
  				if exists(select * from Platillo where Platillo.id_platillo=platiAct) then
  					update Pedido set Pedido.id_orden=ordenAct,
  									  Pedido.id_platillo=platiAct,
  									  Pedido.nota=notaAct,
  									  Pedido.estatus=estatusAct
  					where Pedido.id_orden=orden and Pedido.id_platillo=platillo;
  					set respuesta=1; -- Actualizacion Exitosa en Restaurante
  				else
  					set respuesta=2;
  				end if;
  			else
  				set respuesta=3; -- No existe esa Orden
  			end if;
  		else
  			set respuesta=4; -- La PK actualizada ya existe
  		end if;
  	else
  		set respuesta=0; -- No existe ese Pedido
  	end if;
    return respuesta;
end$$

--
delimiter $$
create function ActualizarAdministrador(usuario varchar(7), usuarioAct varchar(7), contraAct varchar(10), correoAct varchar(40),
										restAct varchar(7), telefonoAct varchar(10)) returns varchar(4)
begin
  	declare respuesta varchar(4);
  	if exists(select * from Administrador where Administrador.usuario=usuario) then
  		if(usuario=usuarioAct or not exists(select * from Administrador where Administrador.usuario=usuarioAct)) then
  			if exists(select * from Restaurante where Restaurante.id_restaurante=restAct) then
  				update Administrador set Administrador.usuario=usuarioAct,
  										 Administrador.contrasena=contraAct,
  										 Administrador.correo=correoAct,
  										 Administrador.id_restaurante=restAct,
  										 Administrador.telefono=telefonoAct
  				where Administrador.usuario=usuario;
  				set respuesta=1; -- Actualizacion Exitosa en Administrador
  			else
  				set respuesta=2; -- No existe ese Restaurante
  			end if;
  		else
  			set respuesta=3; -- La PK actualizada ya existe
  		end if;
  	else
  		set respuesta=0; -- No existe ese Administrador
  	end if;
    return respuesta;
end$$

-- ===================================== Usuarios =================================================================
-- *************************************************************************************
-- Administrador
-- drop user'administrador'@'localhost';
grant all privileges on restauranteGPS.*
to 'administradorG'@'localhost'
identified by '123456';
-- *************************************************************************************

-- *************************************************************************************
-- Administrador por Restaurante
-- drop user 'administradorR'@'%';
grant EXECUTE ON PROCEDURE restauranteGPS.VerSucursalRestaurante
to 'administradorR'@'localhost'
identified by 'contrasena';

grant EXECUTE ON PROCEDURE restauranteGPS.VerSucursalEspecifica
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerTiene
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerEmpleadoRestaurante
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerEmpleadoSucursal
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerResenaPlatillo
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerOrdenSucursal
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerPedidoOrden
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerPedidoEspecifico
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerAdministradorRestaurante
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.EliminarRestaurante
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.EliminarSucursal
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.EliminarPlatillo
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.EliminarTiene
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.EliminarEmpleado
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.EliminarOrden
to 'administradorR'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.EliminarPedido
to 'administradorR'@'localhost';

grant EXECUTE ON function restauranteGPS.InsertarSucursal
to 'administradorR'@'localhost';

grant EXECUTE ON function restauranteGPS.InsertarPlatillo
to 'administradorR'@'localhost';

grant EXECUTE ON function restauranteGPS.InsertarTiene
to 'administradorR'@'localhost';

grant EXECUTE ON function restauranteGPS.InsertarEmpleado
to 'administradorR'@'localhost';

grant EXECUTE ON function restauranteGPS.ActualizarSucursal
to 'administradorR'@'localhost';

grant EXECUTE ON function restauranteGPS.ActualizarPlatillo
to 'administradorR'@'localhost';

grant EXECUTE ON function restauranteGPS.ActualizarTiene
to 'administradorR'@'localhost';

grant EXECUTE ON function restauranteGPS.ActualizarEmpleado
to 'administradorR'@'localhost';

grant EXECUTE ON function restauranteGPS.ActualizarAdministrador
to 'administradorR'@'localhost';
-- *************************************************************************************

-- *************************************************************************************
-- Empleado
-- drop user 'empleado'@'%';
grant EXECUTE ON PROCEDURE restauranteGPS.VerSucursalRestaurante
to 'empleado'@'localhost'
identified by 'contrasena';

grant EXECUTE ON PROCEDURE restauranteGPS.VerSucursalEspecifica
to 'empleado'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerTiene
to 'empleado'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerOrdenSucursal
to 'empleado'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerPedidoOrden
to 'empleado'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerPedidoEspecifico
to 'empleado'@'localhost';

grant EXECUTE ON function restauranteGPS.ActualizarOrden
to 'empleado'@'localhost';

grant EXECUTE ON function restauranteGPS.ActualizarPedido
to 'empleado'@'localhost';
-- *************************************************************************************

-- *************************************************************************************
-- Usuario
-- drop user 'usuario'@'%';
grant EXECUTE ON PROCEDURE restauranteGPS.VerRestaurante
to 'usuario'@'localhost'
identified by 'contrasena';

grant EXECUTE ON PROCEDURE restauranteGPS.VerSucursalRestaurante
to 'usuario'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerSucursalEspecifica
to 'usuario'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerTiene
to 'usuario'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerUsuarioEspecifico
to 'usuario'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerResenaPlatillo
to 'usuario'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerResenaEspecifica
to 'usuario'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerOrdenUsuario
to 'usuario'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerPedidoOrden
to 'usuario'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.VerPedidoEspecifico
to 'usuario'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.EliminarPedido
to 'usuario'@'localhost';

grant EXECUTE ON PROCEDURE restauranteGPS.EliminarResena
to 'usuario'@'localhost';

grant EXECUTE ON function restauranteGPS.InsertarOrden
to 'usuario'@'localhost';

grant EXECUTE ON function restauranteGPS.InsertarPedido
to 'usuario'@'localhost';

grant EXECUTE ON function restauranteGPS.InsertarResena
to 'usuario'@'localhost';

grant EXECUTE ON function restauranteGPS.ActualizarResena
to 'usuario'@'localhost';

grant EXECUTE ON function restauranteGPS.ActualizarUsuario
to 'usuario'@'localhost';
-- *************************************************************************************
