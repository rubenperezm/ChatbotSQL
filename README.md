# chatbotBD

NOTA: CUANDO SE EXPLICA LA CONFIGURACIÓN DE LOS .env, POR SEGURIDAD GITHUB SUPRIME LOS PARÁMETROS. PARA VERLOS, PODÉIS LEER EL TEXTO RAW
## Introducción
Este proyecto consiste en una plataforma de aprendizaje de SQL. Consta de dos partes: una parte hecha en PHP & Laravel, que constituye la plataforma en sí, y otra parte
elaborada con Node.js, que sería la encargada de conectar la plataforma con un chatbot de IBM Watson Assistant (basado en https://github.com/watson-developer-cloud/assistant-simple).

## Requisitos previos
Para poder instalar este proyecto, es necesario tener instalado Composer y NPM, así como tener lo necesario para trabajar con PHP y Node.js. Tendremos que tener las bases de
datos de la configuración y de las pruebas, y tenerlas localmente en MySQL, en nuestro equipo (en el servidor ya están). En caso de tener que ampliar o cambiar el flujo del
diálogo del chatbot será necesario también disponer del archivo con la configuración del chatbot de IBM, e importarlo en nuestra cuenta de IBM.

## Manual de instalación
Lo primero que debemos hacer será importar nuestro proyecto en la carpeta /var/www/html: git clone https://github.com/rubenperezm/Chatbot.git.

Acto seguido, en la carpeta App, tendremos que ejecutar <<composer install>> y <<composer update>>.
  
Tendremos que crear el archivo .env en la misma carpeta. Para ello, se dispone en este proyecto de un .env.example, que habrá que rellenar con los datos necesarios, y habrá que
añadir también las dos bases de datos aquí. A continuación se muestra un ejemplo de cómo habría que configurar esta parte para que funcione en el ordenador del desarrollador:
  APP_URLP=http://localhost
  APP_BOT=http://localhost:3000 //si tenéis que lanzar el proyecto en el servidor, mirad como está configurado el .env del proyecto que ya está subido en el servidor

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=chatbotbd
  DB_USERNAME=root
  DB_PASSWORD= << contraseña del root del equipo en el que se trabaje >>

  DB_CONNECTION_SECOND=mysql
  DB_HOST_SECOND=127.0.0.1
  DB_PORT=3306
  DB_DATABASE_SECOND=pruebas
  DB_USERNAME_SECOND=root
  DB_PASSWORD_SECOND= <<contraseña del root del equipo en el que se trabaje>>


Lo último que tendremos que hacer en esta parte será ejecutar el comando << php artisan key:generate >> (necesario haber hecho el paso anterior) y comprobar que los permisos de
App/storage/ y App/bootstrap/cache/ sean los apropiados, y ejecutar << sudo chown -R $USER:www-data App/storage/ >> y << sudo chown -R $USER:www-data App/bootstrap/cache/ >> 
para cambiar el grupo de los archivos a www-data (Cuidado que en el servidor este grupo se llama apache). Para lanzar el proyecto, usaremos << php artisan ser >>.

Para el servidor intermedio de Node.js (en la carpeta botBD), será necesario también crear un archivo .env. Disponemos de otro archivo .env.example, que podemos utilizar como
base. Los cambios que hay que hacer son los siguientes:
  # Environment variables
ASSISTANT_URL= <<url del asistente>> // Por lo general, https://api.eu-gb.assistant.watson.cloud.ibm.com/instances/<<id_instancia>>
ASSISTANT_ID= <<id del asistente>>

# IBM Cloud connection parameters
ASSISTANT_IAM_APIKEY= <<apikey>>
ASSISTANT_IAM_URL=

# Cloud Pak for Data connection parameters
BEARER_TOKEN=
DISABLE_SSL_VERIFICATION=false

Todos estos parámetros los obtendrás desde tu cuenta de IBM, una vez esté fichero del asistente subido.
Ahora, tendremos que ejecutar los siguientes comandos, esta vez desde la carpeta botBD: <<npm install>>, <<npm update>>, <<npm audit fix>>.
Por último, es de suma importancia realizar cambios en 3 ficheros para poder trabajar de forma local:
  · En botBD/public/js/conversation.js, encontrarás 4 URLs. Tendrás que cambiar https a http, y chatbotsql.uca.es a localhost.
  · Los ficheros botBD/public/js/api.js y botBD/public/index.html contienen ciertos enlaces del estilo "/watson/...". Esto se debe a que en el servidor está configurado para que
  esa ruta sea que conecte con el servidor intermedio aunque este esté lanzado de forma local. Como cuando estés trabajando no lo tendrás así, tendrás que quitar <</watson>> de
  cada uno de estos enlaces (muy importante dejar la barra posterior: /watson/abc --> /abc). Acuérdate de esto cuando vayas a subir alguna actualización al servidor, y en la
  medida de lo posible, cuando hagas un git add, no lo hagas del todo el proyecto, sólo de los ficheros que modifiques para no tener que estar haciendo estos cambios una y otra
  vez.
Cuando tengas todo, podrás lanzar esta parte con <<npm start>>.
  
También tendrás que crear un fichero llamado chatbot.conf de configuración de Apache (posiblemente, dentro de la carpeta /etc/apache2/sites-available), con la siguiente información:

<VirtualHost *:80>
	ServerAdmin webmaster@localhost
	ServerName chatbot
	DocumentRoot /var/www/html/sqlchatbot/App/public
	<Directory /var/www/html/sqlchatbot/App/public>
    	Options Indexes FollowSymLinks MultiViews
    	AllowOverride All
    	Order allow,deny
    	allow from all
    	Require all granted
	</Directory>

	LogLevel debug
	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

Después, deshabilitamos la configuración por defecto con << sudo a2dissite 000-default.conf >> y habilitamos la nueva con << sudo a2ensite chatbot.conf >>.
Para recargar Apache, ejecutamos << sudo systemctl reload apache2 >>.

Es bastante aconsejable que la primera vez que importes el proyecto, crees un repositorio propio con él, para que puedas actualizar los cambios cuando quieras y sin problemas.
