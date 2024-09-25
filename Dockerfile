# Usar la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Instalar extensiones necesarias de PHP (por ejemplo, mysqli para conexión con MySQL)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar el código fuente a la carpeta del servidor web en el contenedor
COPY . /var/www/html/

# Exponer el puerto 80 para que el servidor web sea accesible
EXPOSE 80
