create table tb_roles (
	id				serial primary key,
	descripcion			varchar(25)
);

create table tb_porcentajes (
	id				serial primary key,
	id_roles			int references tb_roles(id),
	fecha				timestamp not null default now(),
	porcentaje			real not null
);

create table tb_nacionalidad (
	id				serial primary key,
	nacionalidad			varchar(1)
);

create table tb_usuarios (
	cedula				integer primary key,
	id_nacionalidad			int references tb_nacionalidad(id),
	id_rol				int references tb_roles(id),
	nombre				varchar(25) not null,
	apellido			varchar(25) not null,
	telefono			varchar(11) not null,
	email				varchar(25) not null,
	direccion			varchar(255) not null,
	fecha_ingreso			timestamp not null default now(),
	fecha_egreso			timestamp,
	usuario				varchar(15) not null,
	password			varchar(33) not null,
	estatus				boolean default true
);

create table tb_bancos (
	id				serial primary key,
	nombre				varchar(25) not null
);

create table tb_cuentas (
	id				serial primary key,
	id_banco			int references tb_bancos(id),
	tipo				varchar(1) not null,
	cuenta				varchar(20) not null
);

create table tb_tipo_transacciones (
	id				serial primary key,
	tipo				varchar(25) not null
);

create table tb_estatus_transacciones (
	id				serial primary key,
	estatus				varchar(25) not null
);

create table tb_transacciones (
	id				serial primary key,
	cedula_usuario			integer references tb_usuarios(cedula),
	id_cuenta			int references tb_cuentas(id),
	id_tipo_transaccion		int references tb_tipo_transacciones(id),
	id_estatus_transaccion		int references tb_estatus_transacciones(id) default 1,
	fecha				timestamp not null,
	monto				real not null,
	deposito			varchar(20)
);

create table tb_tipo_pago (
	id				serial primary key,
	tipo				varchar(40)
);

create table tb_estatus_solicitud_prestamo (
	id				serial primary key,
	estatus				varchar(9) not null
);

create table tb_solicitud_prestamo (
	id				serial primary key,
	id_estatus_solicitud_prestamo	int references tb_estatus_solicitud_prestamo(id) default 1,
	id_tipo_pago			int references tb_tipo_pago(id),
	cedula_usuario			integer references tb_usuarios(cedula),
	monto				real not null,
	fecha				timestamp not null,
	tiempo				integer not null,
	porcentaje			integer,
	observacion			text,
	respuesta			text
);

create table tb_prestamo (
	id_solicitud_prestamo		int references tb_solicitud_prestamo(id),
	id_transaccion			int references tb_transacciones(id),
	primary key(id_solicitud_prestamo, id_transaccion)
);

create table tb_notificaciones (
	id				serial primary key,
	cedula_usuario			integer references tb_usuarios(cedula),
	fecha				timestamp,
	asunto				varchar(255) not null,
	mensaje				text not null
);

comment on column tb_roles.id is 'ID del rol';
comment on column tb_roles.descripcion is 'Descripción del rol Administrador, Asociado, No Asociado';

comment on column tb_porcentajes.id is 'ID';
comment on column tb_porcentajes.id_roles is 'ID del rol';
comment on column tb_porcentajes.fecha is 'Fecha';
comment on column tb_porcentajes.porcentaje is 'Porcentaje';

comment on column tb_usuarios.cedula is 'Cédula de Identidad';
comment on column tb_usuarios.id_rol is 'Referencia con la tabla tb_toles(id_rol)';
comment on column tb_usuarios.nombre is 'Nombre';
comment on column tb_usuarios.apellido is 'Apellido';
comment on column tb_usuarios.telefono is 'Teléfono';
comment on column tb_usuarios.email is 'Email';
comment on column tb_usuarios.direccion is 'Dirección';
comment on column tb_usuarios.fecha_ingreso is 'Fecha de ingreso';
comment on column tb_usuarios.usuario is 'Usuario';
comment on column tb_usuarios.password is 'password';

comment on column tb_bancos.id is 'ID del banco';
comment on column tb_bancos.nombre is 'Nombre del banco';

comment on column tb_cuentas.id is 'ID de la cuenta';
comment on column tb_cuentas.id_banco is 'Referencia a la tabla tb_bacos(id)';
comment on column tb_cuentas.tipo is 'Tipo de cuenta';
comment on column tb_cuentas.cuenta is 'Número de cuenta';

comment on column tb_tipo_transacciones.id is 'ID del tipo de transacción';
comment on column tb_tipo_transacciones.tipo is 'Tipo de transacción';

comment on column tb_estatus_transacciones.id is 'ID del estatus de transacción';
comment on column tb_estatus_transacciones.estatus is 'Estatus de la transacción';

comment on column tb_transacciones.id is 'ID del transaccion';
comment on column tb_transacciones.cedula_usuario is 'Cédula de identidad del usuario';
comment on column tb_transacciones.id_cuenta is 'ID de la cuenta donde se ha realizado el transaccion';
comment on column tb_transacciones.id_tipo_transaccion is 'ID del tipo de de transacción';
comment on column tb_transacciones.fecha is 'Fecha del transaccion';
comment on column tb_transacciones.monto is 'Monto del transaccion';
comment on column tb_transacciones.deposito is 'Número del depósito';
	
comment on column tb_tipo_pago.id is 'ID del tipo de pago';
comment on column tb_tipo_pago.tipo is 'Tipo de pago';

comment on column tb_estatus_solicitud_prestamo.id is 'ID del tipo de préstamo';
comment on column tb_estatus_solicitud_prestamo.estatus is 'Estatus del tipo de préstamo';
	
comment on column tb_solicitud_prestamo.id is 'ID de la solicitud de préstamo';
comment on column tb_solicitud_prestamo.id_estatus_solicitud_prestamo is 'ID del estatus del prestamo';
comment on column tb_solicitud_prestamo.id_tipo_pago is 'ID tipo de pago';
comment on column tb_solicitud_prestamo.cedula_usuario is 'Cédula de Identidad';
comment on column tb_solicitud_prestamo.monto is 'Monto del préstamo';
comment on column tb_solicitud_prestamo.fecha is 'Fecha de la solicitud';
comment on column tb_solicitud_prestamo.tiempo is 'Tiempo del préstamo';
comment on column tb_solicitud_prestamo.porcentaje is 'Porcentaje';
comment on column tb_solicitud_prestamo.observacion is 'Observación';
comment on column tb_solicitud_prestamo.respuesta is 'Respuesta';

comment on column tb_notificaciones.id is 'ID de la notificación';
comment on column tb_notificaciones.cedula_usuario is 'Cédula de identidad del usuario';
comment on column tb_notificaciones.fecha is 'Fecha de envío de la notificación';
comment on column tb_notificaciones.asunto is 'Asunto';
comment on column tb_notificaciones.mensaje is 'Mensaje';

insert into tb_roles values(default, 'Administrador');
insert into tb_roles values(default, 'Asociado');
insert into tb_roles values(default, 'No Asociado');

insert into tb_porcentajes values(default, 1, '2009-01-01 01:01', 5.22);
insert into tb_porcentajes values(default, 2, '2009-01-01 01:01', 5.22);
insert into tb_porcentajes values(default, 3, '2009-01-01 01:01', 6.33);
insert into tb_porcentajes values(default, 1, '2010-01-01 01:01', 6.35);
insert into tb_porcentajes values(default, 2, '2010-01-01 01:01', 6.35);
insert into tb_porcentajes values(default, 3, '2010-01-01 01:01', 7.78);
insert into tb_porcentajes values(default, 1, '2011-01-01 01:01', 7.10);
insert into tb_porcentajes values(default, 2, '2011-01-01 01:01', 7.10);
insert into tb_porcentajes values(default, 3, '2011-01-01 01:01', 8.54);
insert into tb_porcentajes values(default, 1, '2012-01-01 01:01', 8.54);
insert into tb_porcentajes values(default, 2, '2012-01-01 01:01', 8.54);
insert into tb_porcentajes values(default, 3, '2012-01-01 01:01', 9.13);

insert into tb_nacionalidad values(default, 'V');
insert into tb_nacionalidad values(default, 'E');

insert into tb_usuarios values(16409503, 1, 1, 'Lilibeth', 'Ramírez', '04165023756', 'liramusik@gmail.com', 'Caracas - Venezuela', default, null, 'liramusik', md5('liramusik'), 'TRUE');
insert into tb_usuarios values(17108742, 1, 2, 'David', 'Mora', '04264719868', 'davidmora000@gmail.com', 'Caracas - Venezuela', default, null, 'davidmora', md5('davidmora'), 'TRUE');
insert into tb_usuarios values(16541550, 1, 3, 'Héctor', 'Lozada', '04268061734', 'imatsu@gmail.com', 'Caracas - Venezuela', default, null, 'hlozada', md5('hlozada'), 'TRUE');

insert into tb_bancos values(default, 'Banco de Venezuela');
insert into tb_bancos values(default, 'BBVA Banco Provincial');
insert into tb_bancos values(default, 'Banesco');
insert into tb_bancos values(default, 'Banco del Tesoro');

insert into tb_tipo_transacciones values(default, 'Aporte mensual');
insert into tb_tipo_transacciones values(default, 'Aporte especial');
insert into tb_tipo_transacciones values(default, 'Pago de préstamo');
insert into tb_tipo_transacciones values(default, 'Excedente');

insert into tb_estatus_transacciones values(default, 'Comprobando');
insert into tb_estatus_transacciones values(default, 'Aceptado');
insert into tb_estatus_transacciones values(default, 'Rechazado');

insert into tb_tipo_pago values(default, 'Pago de Intereses mas Amortización');
insert into tb_tipo_pago values(default, 'Pago de Intereses');

insert into tb_estatus_solicitud_prestamo values(default, 'Pendiente');
insert into tb_estatus_solicitud_prestamo values(default, 'Aprobado');
insert into tb_estatus_solicitud_prestamo values(default, 'Rechazado');
insert into tb_estatus_solicitud_prestamo values(default, 'Pagado');
