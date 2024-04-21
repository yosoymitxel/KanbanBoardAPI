## Kanban Board API

Este proyecto implementa un servicio REST que expone el endpoint `/boards` para gestionar una lista de tareas en formato Kanban. El modelo de datos está predefinido y solo permite lectura.

### Funcionalidades

* **Crear una nueva tarea:** Realiza una petición POST al endpoint `/boards` con un objeto JSON en el cuerpo de la solicitud. El objeto debe contener las propiedades `title` (título de la tarea) pero no `id` ni `stage` (etapa). Se asigna un identificador único (`id`) a la nueva tarea de forma secuencial (el primero tendrá id 1, el segundo id 2, etc.). Todas las tareas nuevas se crean en la etapa 1.
* **Actualizar etapa de una tarea:** Realiza una petición PUT al endpoint `/boards/:id` con la etapa nueva como cuerpo de la solicitud. El parámetro `:id` representa el identificador de la tarea. La etapa solo puede ser 1, 2 o 3. Si se envía un valor inválido, se retorna un código de error 400. Si la etapa es válida, se actualiza la tarea y se devuelve el objeto actualizado en el cuerpo de la respuesta con código 200.

## API

### Funcionalidades

* **Crear una nueva tarea:**
    * Método: POST
    * Endpoint: `/boards`
    * Cuerpo (JSON): {"title": "Título de la tarea"}
    * Respuesta: Código 201 y objeto JSON de la tarea creada con propiedades `id`, `title` y `stage` (siempre 1).
* **Actualizar etapa de una tarea:**
    * Método: PUT
    * Endpoint: `/boards/:id` (reemplaza `:id` con el identificador de la tarea)
    * Cuerpo (JSON): {"stage": nueva_etapa} (nueva_etapa: 1, 2 o 3)
    * Respuesta:
        * Código 200 y objeto JSON de la tarea actualizada si la etapa es válida.
        * Código 400 si la etapa es inválida.

### Dependencias

El proyecto por defecto utiliza la base de datos SQLite3.

### Instalación:

1. Clonar el proyecto: ```git clone https://github.com/yosoymitxel/KanbanBoardAPI.git```
2. Configurar las conexiones dentro del archivo .env
3. Migrar base de datos ```php artisan migrate --seed```
4. Instalar las dependencias de Laravel: ```composer install```

### Ejecución:

1. Iniciar el servidor de Laravel: ```php artisan serve```
2. La aplicación estará disponible en [http://localhost:8000](http://localhost:8000o)


### Test:
Para probar eficazmente tu API Kanban Board con Postman y el archivo ```KanbanBoardAPI.postman_collection.json``` proporcionado.

### Contribuciones

Se aceptan contribuciones al proyecto. Por favor, crea un pull request para enviar tus cambios. 
