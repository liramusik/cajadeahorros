create table tb_roles (
	id		serial primary key,
	descripcion	varchar(25)
);

create table tb_usuarios (
	cedula		varchar(8) primary key,
	nombre		varchar(25) not null,
	apellido	varchar(25) not null,
	telefono	varchar(11) not null,
	email		varchar(25) not null,
	direccion	varchar(255) not null,
	fecha_ingreso	integer not null,
	fecha_egreso	integer,
	aporte_inicial	real not null,
	aporte_mensual	real not null,
	usuario		varchar(10) not null,
	password	varchar(33) not null,
	estatus		boolean,
	id_rol		int references tb_roles(id)
);

create table tb_bancos (
	id		serial primary key,
	nombre		varchar(25) not null
);

create table tb_cuentas (
	id		serial primary key,
	id_banco	int references tb_bancos(id),
	tipo		varchar(1) not null,
	cuenta		varchar(20) not null
);

create table tb_aportes (
	id		serial primary key,
	cedula_usuario	varchar(8) references tb_usuarios(cedula),
	id_banco	int references tb_bancos(id),
	fecha		integer not null,
	monto		real not null,
	deposito	varchar(20)
);

comment on column tb_roles.id is 'ID del rol';
comment on column tb_roles.descripcion is 'Descripción del rol Administrador, Asociado, No Asociado';

comment on column tb_usuarios.cedula is 'Cédula de Identidad';
comment on column tb_usuarios.nombre is 'Nombre';
comment on column tb_usuarios.apellido is 'Apellido';
comment on column tb_usuarios.telefono is 'Teléfono';
comment on column tb_usuarios.email is 'Email';
comment on column tb_usuarios.direccion is 'Dirección';
comment on column tb_usuarios.fecha_ingreso is 'Fecha de ingreso';
comment on column tb_usuarios.aporte_inicial is 'Aporte inicial';
comment on column tb_usuarios.aporte_mensual is 'Aporte mensual';
comment on column tb_usuarios.usuario is 'Usuario';
comment on column tb_usuarios.password is 'password';
comment on column tb_usuarios.id_rol is 'Referencia con la tabla tb_toles(id_rol)';

comment on column tb_bancos.id is 'ID del banco';
comment on column tb_bancos.nombre is 'Nombre del banco';

comment on column tb_cuentas.id is 'ID de la cuenta';
comment on column tb_cuentas.id_banco is 'Referencia a la tabla tb_bacos(id)';
comment on column tb_cuentas.tipo is 'Tipo de cuenta';
comment on column tb_cuentas.cuenta is 'Número de cuenta';

comment on column tb_aportes.id is 'ID del aporte';
comment on column tb_aportes.cedula_usuario is 'Cédula de identidad del usuario';
comment on column tb_aportes.id_banco is 'ID del banco donde se ha realizado el aporte';
comment on column tb_aportes.fecha is 'Fecha del aporte';
comment on column tb_aportes.monto is 'Monto del aporte';
comment on column tb_aportes.deposito is 'Número del depósito';

insert into tb_roles values(default, 'Administrador');
insert into tb_roles values(default, 'Asociado');
insert into tb_roles values(default, 'No Asociado');

insert into tb_usuarios values('16409503', 'Lilibeth', 'Ramírez', '04165023756', 'liramusik@gmail.com', 'Caracas - Venezuela', 1332547200, 0, 10000, 1000, 'liramusik', md5('liramusik'), 'TRUE', 1);
insert into tb_usuarios values('17108742', 'David', 'Mora', '04264719868', 'davidmora000@gmail.com', 'Caracas - Venezuela', 1332547200, 0, 15000, 1500, 'davidmora', md5('davidmora'), 'TRUE', 1);

insert into tb_bancos values(default, 'Banco de Venezuela');
insert into tb_bancos values(default, 'BBVA Banco Provincial');
insert into tb_bancos values(default, 'Banesco');
insert into tb_bancos values(default, 'Banco del Tesoro');
