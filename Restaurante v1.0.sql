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
    ciudad varchar(40) not null,
    estado varchar(40) not null,
    direccion varchar(40) not null,
    h_apertura varchar(10) not null,
    h_cierre varchar(10) not null,
    telefono varchar(10) not null,
    constraint pk_restaurante primary key (id_restaurante),
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
    id_restaurante varchar(7),
    constraint pk_platillo primary key (id_platillo,id_restaurante),
    constraint fk_platillo foreign key (id_platillo) references Platillo(id_platillo) on delete cascade on update cascade,
    constraint fk_restaurante foreign key (id_restaurante) references Restaurante(id_restaurante) on delete cascade on update cascade
);

create table Empleado(
	id_empleado	varchar(7),
    nombre varchar(40) not null,
    contrasena varchar(10) not null,
    correo varchar(40) not null,
    telefono varchar(10) not null,
    id_restaurante varchar(7) not null,
    constraint pk_trabajador primary key(id_empleado),
    constraint fk_restaurante2 foreign key(id_restaurante) references Restaurante(id_restaurante) on delete cascade on update cascade
);

create table Usuario(
	id_usuario varchar(7),
    nombre varchar(40) not null,
    correo varchar(40) not null,
    contrasena varchar(10) not null,
    telefono varchar(10) not null,
    constraint pk_trabajador primary key(id_usuario)
);

create table Resena(
	id_platillo varchar(7),
    id_usuario varchar(7),
    calificacion varchar(1) not null,
    comentario varchar(200) not null,
    constraint pk_resena primary key (id_platillo, id_usuario),
    constraint fk_platillo2 foreign key (id_platillo) references Platillo(id_platillo) on delete cascade on update cascade,
    constraint fk_ususario foreign key (id_usuario) references Usuario(id_usuario) on delete cascade on update cascade
);

create table Orden(
	id_orden varchar(7),
    id_restaurante varchar(7) not null,
    num_mesa varchar(2) not null,
    total float(5,2) not null,
    estatus varchar(10),
    id_usuario varchar(7),
    constraint pk_orden primary key (id_orden),
    constraint fk_restaurante3 foreign key (id_restaurante) references Restaurante(id_restaurante) on delete cascade on update cascade,
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

-- call EliminarPlatillo("pla1235");
delimiter $$
create procedure EliminarPlatillo(in platillo varchar(7))
begin
	Delete from Platillo where id_platillo=platillo;
end$$

-- call EliminarTiene("pla1234","res1234");
delimiter $$
create procedure EliminarTiene(in platillo varchar(7), restaurante varchar(7))
begin
	Delete from Tiene where id_platillo=platillo and id_restaurante=restaurante;
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
create function InsertarRestaurante(restaurante varchar(7), nombreR varchar(40), ciudadR varchar(40), estadoR varchar(40), 
									direccionR varchar(40), aperturaR varchar(10), cierreR varchar(10), telefonoR varchar(10)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Restaurante where id_restaurante=restaurante) then
		if exists(select * from Ciudad where nombre=ciudadR and provincia=estadoR) then
			insert into Restaurante values(restaurante, nombreR, ciudadR, estadoR, direccionR, aperturaR, cierreR, telefonoR);
			set respuesta=1; -- Insercion exitosa en Restaurante
		else
			set respuesta=2; -- No existe esa combinacion de Ciudad y Provincia
		end if;
	else
		set respuesta=0; -- Ya existe ese Restaurante
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
create function InsertarTiene(platillo varchar(7), restaurante varchar(7)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Tiene where id_platillo=platillo and id_restaurante=restaurante) then
		if exists(select * from Platillo where id_platillo=platillo) then
			if exists(select * from Restaurante where id_restaurante=restaurante) then
				insert into Tiene values(platillo, restaurante);
				set respuesta=1; -- Insercion exitosa en Tiene
            else
             set respuesta=2; -- No existe ese restaurante
			end if;
        else
		 set respuesta=3; -- No existe ese platillo
		end if;
	else
		set respuesta=0; -- Ya existe ese relacion de Platillo y Restaurante
	end if;
    return respuesta;
end$$

-- drop function InsertarEmpleado
-- select InsertarEmpleado("emp1236","Alan Zamora Barrera","contra1234","alanzamora@gmail.com","8331234567","res1235");
delimiter $$
create function InsertarEmpleado(emp varchar(7), nombreE varchar(40), contra varchar(10), correoE varchar(40), telefonoE varchar(10), restE varchar(7)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Empleado where id_empleado=emp) then
		if exists(select * from Restaurante where id_restaurante=restE) then
			insert into Empleado values(emp, nombreE, contra, correoE, telefonoE, restE);
			set respuesta=1; -- Insercion exitosa en Empleado
		else
			set respuesta=2; -- No existe ese Restaurante
		end if;
	else
		set respuesta=0; -- Ya existe ese Empleado
	end if;
    return respuesta;
end$$

-- select InsertarUsuario("usu1235","Ana Cavazos Argot","anaowo@gmail.com","anaowo2","8331254976");
delimiter $$
create function InsertarUsuario(usuario varchar(7), nombreU varchar(40), correoU varchar(40), contra varchar(10), teleU varchar(10)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Usuario where id_usuario=usuario) then
		insert into Usuario values(usuario, nombreU, correoU, contra, teleU);
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
create function InsertarOrden(orden varchar(7), restO varchar(7), mesa varchar(2), total float(5,2), estatus varchar(10), usuario varchar(7)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Orden where id_orden=orden) then
		if exists(select * from Restaurante where id_restaurante=restO) then
			if exists(select * from Usuario where id_usuario=usuario) then
				insert into Orden values(orden, restO, mesa, total, estatus, usuario);
				set respuesta=1; -- Insercion exitosa en Orden
            else
             set respuesta=2; -- No existe ese Usuario
			end if;
        else
		 set respuesta=3; -- No existe ese Restaurante
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
delimiter $$
create function InsertarAdministrador(usuA varchar(7), contra varchar(10), correoA varchar(40), restA varchar(7), telefonoA varchar(10)) returns varchar(4)
begin
	declare respuesta varchar(4);
    if not exists(select * from Administrador where usuario=usuA) then
		if exists(select * from Restaurante where id_restaurante=restA) then
			insert into Administrador values(usuA, contra, correoA, restA, telefonoA);
			set respuesta=1; -- Insercion exitosa en Empleado
		else
			set respuesta=2; -- No existe ese Restaurante
		end if;
	else
		set respuesta=0; -- Ya existe ese Administrador
	end if;
    return respuesta;
end$$