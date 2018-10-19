# easycredit

#Instalación de prerequisitos

Para este proyecto de utilizo Xampp (con php 7.2.11) 
	-enlace de descarga: https://www.apachefriends.org/es/index.html
	-ejecutar el instalable (de preferencia como administrador)
	-ya instalado, iniciar el proceso de mySql

Instalar Composer: https://getcomposer.org/download/
	Windows installer

Instalacion de laravel
	-Documentacion de instalacion: https://laravel.com/docs/5.7
	-primeramente se descarga el instalador de laravel por medio de Composer
	-despues en la ubicacion donde estará el proyecto en consola, se ejecuta el comando: laravel new easycredit
	-para iniciar laravel en la raiz del proyecto por consola se ejecuta: php artisan serve

Instalacion de NodeJS 8.12.0
	-enlace de descarga: LTS: https://nodejs.org/es/
	-en raiz de proyecto por consola ejecutar: NPM install
		para que se instalen dependencias y plugin que se usan en el proyecto
	-en raiz de proyecto por consola ejecutar: npm run watch
		para compilar los archivos js y scss

En caso de que no se instalen automaticamente,
	Vuex: npm install vuex --save
	Vue Numeric: npm install vue-numeric --save

#Base de datos

En este caso, se utilizó las migraciones y seeders de laravel
por lo que nada mas se debera crear la base de datos por medio de este script:
	create database easy_credit
si se presentan problemas al conectar a base de datos, posiblemente sea necesario
revisar el archivo .env para verificar que este correcto el nombre de la base de datos
en el apartado DB_DATABASE.

teniendo la base de datos creada, por medio de consola en la raiz del proyecto
se ejecutan los comandos
	-composer dump-autoload
	-php artisan migrate --seed

si se presentan problemas al momento de migrar intentar con: php artisan migrate --force o php artisan migrate:refresh y por separado php artisan db:seed

#Asunciones durante la construcción de la solución

Para este proyecto, no vi la necesidad de utilizar querys de mysql tal cual, como he venido trabajando con laravel se utilizó el querybuilder que trae integrado, que hasta cierto punto facilita un poco la obtencion de los datos al ya tener todo un proceso desarrollado para esto, los mismo para la creacion de la tablas, y en los modelos de cada tabla se podran encontrar las relaciones utilizadas para la obtencion de datos.

Para el formulario, en añadirlo en el mismo espacio del listado de solicitudes, pero debido a que ese espacio podria hacerse muy grande y ademas de no verse bien, decidi hacer uso de un modal que no ocupara mucho tamaño.

Tambien para el diseño, tome la decision de mantanerlo hasta cierto punto parecido al de documento, para no centrarme tanto en este y digirir los esfuerzo a lo que es el back-end.

Ademas, para front-end, se utilizó vuejs, con sus complementos vue numeric y vuex, debido a que con este framework me permite mantener separados los componentes utilizados y ademas permite su reutilizacion (si es necesaria) en otras ubicaciones y no se necesita la utilizacion de jquery directamente.

con vuex potencializa mas vuejs, ya que permite mantener un storage al cual todos los componentes podran acceder si se importan, asi de esta forma un mismo dato del storage se podra utilizar en diferentes componentes y ademas al momento de cambiar el valor y se disparara el cambio que se vera reflejado en todos los componentes.

Para el calculo del interes, decidi utilizar el calculos para interes simple, ya que si bien en el documento se especifica que debe ser en tales plazos y a cierto porcentaje, no define si es simple o compuesto (son los que conozco).

#Problemas que se presentaron al resolver el ejercicio

Un problema que se presento al momento de estar realizando el proyecto, fue el la realizacion de aceptacion o rechazo de las solicitudes de manera automatica, debido a que en mi experiencia no habia utilizado alguna herramienta o solucion para esto, basicamente es la primera vez que utilice algo parecido.
Leyendo la documentacion de laravel, hay una manera de hacer esto posible utilizando las virtudes de este framework, son los comandos (hablaré un poco de esto en el video).
Teniendo ya el codigo para la realizacion automazida de esto y con una prueba mediante consola y verificando que se haya ejecutado de manera correcta, surgio el problema de como hacer que ocurra el disparador de este evento.
Entonces habian muchas posibilidad, como de manera local mi equipo pues es windows 7, no quise recurrir a la instalacion de programas especificos para por ejecutar el script, asi que me di a la tarea de investigar una manera de hacerlo.
Despues de un rato encontre una manera en la cual si se ejecutaba el codigo, por medio de tarea programada de windows y el uso de un archivo por lotes de windows.

Otro problema que se presento es en el formulario de solicitud, ya que preferí hacer la validacion en backend para usar las librerias de validacion de laravel, sin embargo al momento de validar el monto, por alguna razon la validacion para evitar que el monto sea 0 no funciona, asi que la omiti del codigo.

#Critica sobre ejercicio

En mi opinion es un buen ejercicio, sencillo, pero si creo que seria mejor que estuvieran unas cosas mejor especificadas, como la manera en que se calculas los interes, porque al menos yo se de dos formas, tambien hay cosas demasiado vagas o ambiguas y causan confuncion sobre como desarrollar la solucion, otra cosa es el diseño que se muestra, ya que nada mas muestra los 3 widgets y con unas lineas, que no muestran mas o menos que es lo que se muestra o como deberia mostrarse mas o menos.