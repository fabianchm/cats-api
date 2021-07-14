### Configuración del proyecto

Para el desarrollo de esta prueba técnica se ha montado un proyecto en laravel con las siguientes características:
* Versión de PHP: 8.0.7
* Versión de Laravel: 8.40

Para montar este proyecto en un entorno de desarrollo, clonar el proyecto y ejecutar el siguiente comando para instalar las dependencias:

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

Para levantar el contenedor en docker ejecutar:
```
    ./vendor/bin/sail up
```

### Variables de entorno

Para la conexión con la API externa que suministra las urls de fotos y para el propósito de esta prueba no es neceseria api_key, por lo tanto la única
variable de entorno que hay que añadir es la url de la API: ```CATS_API_URL```. La API que está configurada por defecto es la siguiente: *https://thecatapi.com*

### Funcionalidades

Para obtener una URL aleatoria, hacer una petición **GET** a la ruta */api/cat*. Esta ruta devolverá un objeto JSON con la clave 'url' y como valor una url 
de una foto de gatos.

Para autenticar la petición es necesario proporcionar un token de tipo Bearer que cumpla con una serie de condiciones proporcionadas
por el enunciado de la prueba.

Para ejecutar los test (si se utiliza Laravel Sail) utilizar el comando: ``` ./vendor/bin/sail artisan test ```


