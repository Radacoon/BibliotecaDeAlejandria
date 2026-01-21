SISTEMA DE GESTION DE BIBLIOTECA - LA BIBLIOTECA DE ALEJANDRIA
Este proyecto es una aplicacion web para la gestion de libros desarrollada con PHP y MariaDB. Se ejecuta mediante Docker para asegurar que funcione igual en cualquier computadora.

REQUISITOS PREVIOS:

Tener instalado Docker Desktop.

Tener habilitado Docker Compose.

ESTRUCTURA DEL PROYECTO: El sistema utiliza dos contenedores principales:

Servidor Web: Apache con PHP 8.x (aloja el codigo en la carpeta /www).

Base de Datos: MariaDB (para guardar la informacion).

INSTRUCCIONES PARA ARRANCAR EL PROYECTO:

PREPARACION: Coloque todos los archivos en una carpeta (ejemplo: ~/proyecto_rdr).

INICIO CON DOCKER: Abra una terminal en la carpeta del proyecto y ejecute el comando: docker-compose up -d --build

Este comando hara lo siguiente:

Construira la imagen del servidor web.

Creara automaticamente la carpeta "mysql_data" en su computadora para que no se borren los datos.

Conectara el servidor con la base de datos de forma interna.

VERIFICACION: Escriba "docker ps" en su terminal. Deberia ver activos estos contenedores:

proyecto_rdr-web-1

proyecto_rdr-db-1

ENTRAR AL SISTEMA: Abra su navegador y escriba la siguiente direccion: http://localhost:8080

CONFIGURACION DE LA BASE DE DATOS: Si necesita revisar la conexion, el archivo www/db.php usa estos datos:

Servidor (Host): db

Usuario: alex

Contrasena: wasd

Base de Datos: rdr_db

NOTAS SOBRE LOS DATOS: La carpeta "mysql_data" se genera sola la primera vez que inicia el proyecto. Si quiere borrar todo y empezar de cero, apague los contenedores y borre esa carpeta manualmente.
