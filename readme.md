GET /api/destacadas: 
Devuelve todas las propiedades destacadas
http://localhost/web2/TPE2022-2/api/destacadas

- Filtrar por Operación:
.../api/destacadas?operacion=alquiler -> puede ser venta o alquiler;

- Ordenar por cualquiera de los campos de la tabla:
.../api/destacadas?sort=precio&order=desc -> puede ser en orden ascendente (asc) o descendente (desc);

- Paginar los resultados obtenidos:
.../api/destacadas?limit=6&offset=3 -> LIMIT nos permite limitar la cantidad de propiedades que queremos obtener y OFFSET especifica el número de propiedades que se van a omitir antes de que se recupere alguna.

GET /api/destacadas/:ID
.../api/destacadas/1 -> Devuelve una propiedad destacada por su id;

POST /api/destacadas
.../api/destacadas -> Agrega una propiedad destacada;

DELETE /api/destacadas/:ID
.../api/destacadas/1 -> Elimina una propiedad destacada por su id;

PUT /api/destacadas/:ID
.../api/destacadas/1 -> Edita la informacion de una propiedad destacada por su id;

Endpoints con solicitud de autenticación: DELETE, POST y PUT.
