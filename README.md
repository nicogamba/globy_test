# Aplicación Symfony para consumir datos de personajes de Star Wars

## Acerca de esta aplicación
Esta es una prueba técnica para SocialPubli - Glofy.
Esta aplicación Symfony consume la API de Personajes de Star Wars (https://swapi.dev/api/people) y muestra los datos en una página web mediante una tabla dinámica. Utiliza Docker para facilitar el entorno de desarrollo y despliegue.

A realizar en la prueba:
- Consumir el Api de Personajes de Star Wars https://swapi.dev/api/people mediante un proyecto de symfony 3.4 o superior.
- Realizar un controller que reciba la petición POST de la página a consumir y utilice servicio que a su vez consuma estos datos utilizando la librería Guzzle. Este controller deberá devolver una respuesta JSON con los datos a modo de API.
- Hacer también una vista (sencilla) que consuma este endpoint mediante AJAX y lo pinte dinámicamente en una tabla.
- Entregar el proyecto en un repositorio de Github con las indicaciones pertinentes para instalarlo y ejecutarlo.
- Bonus: montar algún sistema cache en las llamadas para que cachee durante 5 minutos (este valor debe ser fácilmente modificable).

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalados:

- Docker
- Docker Compose

Documentación oficial: https://docs.docker.com/engine/install/

## Instalación y Configuración

#### 1. Clonar el Repositorio:
- Clona este repositorio en tu máquina local con el siguiente comando:
```
git clone git@github.com:nicogamba/socialpubli_prueba.git
```
- Sitúate dentro de la carpeta de la aplicación:
```
cd socialpubli_prueba
```

#### 2. Construir y levantar los contenedores de Docker:
- Desde la raíz del proyecto, ejecuta el siguiente comando para construir y levantar los contenedores:

```
docker-compose up -d --build
```

#### 3. Instalar Dependencias de Composer:
- Con los contenedores levantados, instala las dependencias PHP del proyecto utilizando Composer:

```
composer install
```

#### 4. Acceder a la Aplicación:
- Una vez que todos los contenedores estén en ejecución, puedes acceder a la aplicación desde tu navegador web: http://localhost:8080
- **Nota:** Es importante que **sea http**, y **no https**, ya que habría conflictos por los certificados y no se podría visualizar la página. Si el navegador redirige automáticamente, se puede intentar desde una navegación incógnita (yo lo soluciono así con Chrome).

## Uso de la Aplicación
#### - Página Principal:
- La página principal muestra una tabla con los personajes de Star Wars obtenidos de la API.
- Utiliza el formulario para especificar la página de personajes que deseas ver y presiona "Obtener datos".
- Puedes ir cambiando de página para ver como reacciona utilizando la caché.

#### - Endpoint de personajes
- El endpoint */api/people* está disponible para obtener los datos de los personajes en formato JSON. Puedes acceder a él mediante una solicitud POST.

## Notas Adicionales
#### - Configuración de Cache:
- La duración de la caché se configura mediante la variable de entorno CACHE_EXPIRY. Ajusta este valor en el archivo .env según sea necesario. Cuando se clona el repositorio, viene configurado en 300 segundos (5 minutos).

