Para la plantilla, opté por crear un nuevo controlador por si se quieren mostrar datos dinámicos en plantilla más adelante, por ello la plantilla es /templates/home/index.html.twig

Para la utilización del proyecto simplemente descomprimir el zip en /var/www/html
o en caso de xampp c:/xampp/htdocs, y abrir una terminal en ese directorio en la que introduciremos el composer install para descargar las dependencias

Endpoints:
Inicio: http://127.0.0.1:8000

Listado Habitaciones: http://127.0.0.1:8000/habitacion (TWIG) <br>
Insertar Habitacion: http://127.0.0.1:8000/habitacion/insertar <br>
Editar Habitacion: http://127.0.0.1:8000/habitacion/{id}/editar <br>
Eliminar Habitacion: http://127.0.0.1:8000/habitacion/{id}/eliminar <br>

Listado Clientes: http://127.0.0.1:8000/cliente (JSON) <br>
Insertar Cliente: http://127.0.0.1:8000/cliente/insertar <br>

Listado Reservas: http://127.0.0.1:8000/reserva (TWIG) <br>
Insertar Reserva: http://127.0.0.1:8000/reserva/insertar <br>
 
Consultas Complejas: http://127.0.0.1:8000/consultas (JSON)