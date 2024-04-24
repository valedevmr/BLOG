# PRUEBA BLOG REST API
aplicación web en Codegniter Bajo REST FULL

## Descripción
Se realizo un servicio rest full para la creacion de post en un blog, se implemento en CodeIgniter 4(CI4) y mysql.
se creo un end-point para la alta de usuario mediente correo y contraseña.
se agrego seguridad a la api mediente JSON WEB TOKEN, validando este token mediente un Middelware al realizar peticiones a rutas de la api rest.
se desarrollo un crud completo para los post del blog.


## Requerimientos para el proyecto:
- Clonar este repositorio https://github.com/valedevmr/Blog.git
- Dentro del repositorio esta la base de datos de nombre Blog.sql, esta debes de importarla en tu local, ya sea con dbeaver, antares o cualquer otra herramienta que soporte mysql

## Paso para prepara ambiente.

- Una vez que clones el repositorio, ubicarse en el directorio raiz del proyecto.
- Posterior a ello, ejecutar el comando 'composer update' y despues 'composer install', esto es para descargar dependencias, en este caso para los jwt.
- posterior a ello, ejecutamos en la terminal o cmd en el proyecto raiz el comanod 'php spark serve' y con eso ya tendras corriendo la pai rest full.

- para realizar peticiones se puede consultar el documento .doc adjunto en estet proyecto, los documento son: Documentacion rest.docs y Insomnia_2024-04-24.json
