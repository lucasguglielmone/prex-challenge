# PREX ASSESMENT

## Descripcion
Este proyecto se realiza como parte del desafío Prex, que consiste en integrarse con una API existente y desarrollar una API REST propia que exponga un conjunto de servicios.

## Configuración del Proyecto
### Instalación
Clona este repositorio en tu máquina local.
Configura tu entorno de desarrollo siguiendo las instrucciones del archivo README.md.
Ejecuta el servidor de desarrollo con el comando php artisan serve.
### Uso
Para utilizar la API, sigue la documentación proporcionada en la sección de requisitos. Asegúrate de incluir la autenticación OAuth2.0 en tus solicitudes.

### Contribución
Si deseas contribuir a este proyecto, por favor sigue los siguientes pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama (git checkout -b feature/nueva-funcionalidad).
3. Realiza tus cambios y realiza un commit (git commit -am 'Añade nueva funcionalidad').
4. Sube tus cambios al repositorio (git push origin feature/nueva-funcionalidad).
5. Crea un nuevo Pull Request.


## API Reference

#### Authentication

```http
  POST /api/login
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Required**. Your personal email |
| `password` | `string` | **Required**. min. 6 characters |

```http
  POST /api/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Required**. Your personal email |
| `password` | `string` | **Required**. min. 6 characters |
| `name` | `string` | **Required**. min. 6 characters |


### Following endpoints require authentication:
#### Search GIFs  based on given keyword
```http
  POST /api/gifs/search
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `query`      | `string` | **Required**. keyword for GIF search |
| `limit`      | `integer` | **Required**. limit per search |
| `offset`      | `integer` | **Required**. search offset |


#### Search GIF by ID
```http
  POST /api/gifs/search/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. GIF id |

#### Toggle favorite GIF
```http
  POST /api/gifs/favorite
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `gif_id`      | `string` | **Required**. GIF id |
| `alias`      | `string` | **Required**. GIF alias |
| `user_id`      | `integer` | **Required**. Id of user that wants to add a fav. GIF |
