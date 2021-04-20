# Sistema de Inventario y Ventas de uso general (Aun en desarrollo)

## Funciones
- Ten control de tus producto (precio, stock, compra y mas)
- Ten control de tus ventas
- Ten control de clientes y provedores
- Gestiona los usuarios del sistema

## Caracteristicas del sistema

- Utilización de CodeIgniter 4
- Uso de Ajax
- Uso de Bootstrap 4
- Iconos Fontawesome
- Inicio de sesión y registro de usuarios 
- CRUD de productos, clientes, provedores, ventas, categorias para productos

## Migraciones

Configura la conexión a tu base de datos en el archivo `.env`.

Ejecutar el siguiente comando en la raiz del proyecto para aplicar las migraciones:

    php spark migrate

Luego ejecuta el seeder para el correcto funcionamiento del sistema (app/Database/Seeds/InitSeed.php):

    php spark db:seed InitSeed


**By Noubot**
