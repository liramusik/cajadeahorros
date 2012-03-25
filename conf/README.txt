Configuración del servidor de base de datos

1.- Instale el servidor postgresql
2.- Como administrador cambiarse al usuario postgresql
	$ su postgres
3.- Crear el usuario user_cadeveher y colocar como contraseña 123456
	$ createuser user_cadeveher -W
4.- Crear la base de datos db_cadeveher
	$ createdb -U user_cadeveher -W db_cadeveher
5.- Restaurar la base de datos
	$ psql -U user_cadeveher -W db_cadeveher < db_cadeveher.sql
6.- No modificar el archivo de configuración
